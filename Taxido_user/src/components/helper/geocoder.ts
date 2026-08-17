import { Platform } from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import store from '@src/api/store';

const GOOGLE_KEY =
  Platform.OS === 'android'
    ? 'AIzaSyAYO9JefUbsWoyAk-gRyoJh_eFWaIpZHDY'
    : 'AIzaSyAYO9JefUbsWoyAk-gRyoJh_eFWaIpZHDY';

const NOMINATIM_REVERSE = 'https://nominatim.openstreetmap.org/reverse';
const NOMINATIM_SEARCH = 'https://nominatim.openstreetmap.org/search';

const NOMINATIM_HEADERS = {
  'User-Agent': 'LivrikoRiderApp/1.0 (mobile app)',
};

export interface GoogleAddressComponent {
  long_name: string;
  short_name: string;
  types: string[];
}

export interface GoogleGeocodeResult {
  formatted_address: string;
  address_components: GoogleAddressComponent[];
  geometry: { location: { lat: number; lng: number } };
  place_id?: string;
}

export interface GoogleGeocodeResponse {
  status: string;
  results: GoogleGeocodeResult[];
  error_message?: string;
}

export interface GooglePrediction {
  description: string;
  place_id: string;
  structured_formatting: {
    main_text: string;
    secondary_text: string;
  };
  latitude?: number;
  longitude?: number;
}

export interface GoogleAutocompleteResponse {
  status: string;
  predictions: GooglePrediction[];
  error_message?: string;
}

const getMapProvider = (): string => {
  try {
    const state = store.getState() as any;
    return (
      state?.setting?.taxidoSettingData?.cabbooking_values?.location
        ?.map_provider || 'osm'
    );
  } catch (e) {
    return 'osm';
  }
};

const getLanguage = async (): Promise<string> => {
  try {
    const lang = await AsyncStorage.getItem('selectedLanguage');
    return lang || 'en';
  } catch (e) {
    return 'en';
  }
};

const mapNominatimAddress = (address: any): GoogleAddressComponent[] => {
  const components: GoogleAddressComponent[] = [];
  const add = (name: string, types: string[]) => {
    if (name) {
      components.push({ long_name: name, short_name: name, types });
    }
  };

  add(address?.house_number, ['street_number']);
  add(address?.road, ['route']);
  add(address?.suburb, ['sublocality_level_1', 'sublocality']);
  add(address?.neighbourhood, ['neighborhood']);
  add(address?.city || address?.town || address?.village, ['locality', 'political']);
  add(address?.county, ['administrative_area_level_2', 'political']);
  add(address?.state, ['administrative_area_level_1', 'political']);
  add(address?.postcode, ['postal_code']);
  add(address?.country, ['country', 'political']);
  add(address?.country_code?.toUpperCase(), ['country', 'political']);
  return components;
};

const nominatimReverse = async (
  lat: number,
  lng: number,
): Promise<GoogleGeocodeResponse> => {
  const lang = await getLanguage();
  const url = `${NOMINATIM_REVERSE}?format=jsonv2&addressdetails=1&lat=${lat}&lon=${lng}&accept-language=${lang}`;
  const res = await fetch(url, { headers: NOMINATIM_HEADERS });
  const json = await res.json();

  if (!json || json.error || !json.display_name) {
    return { status: 'ZERO_RESULTS', results: [] };
  }

  return {
    status: 'OK',
    results: [
      {
        formatted_address: json.display_name,
        address_components: mapNominatimAddress(json.address),
        geometry: {
          location: { lat: parseFloat(json.lat), lng: parseFloat(json.lon) },
        },
        place_id: json.place_id?.toString(),
      },
    ],
  };
};

const googleReverse = async (
  lat: number,
  lng: number,
): Promise<GoogleGeocodeResponse> => {
  const url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=${GOOGLE_KEY}`;
  const res = await fetch(url);
  return res.json();
};

export const reverseGeocode = async (
  lat: number,
  lng: number,
): Promise<GoogleGeocodeResponse> => {
  if (!lat || !lng || isNaN(lat) || isNaN(lng)) {
    return { status: 'ZERO_RESULTS', results: [] };
  }
  if (getMapProvider() === 'osm') {
    return nominatimReverse(lat, lng);
  }
  return googleReverse(lat, lng);
};

const nominatimSearch = async (
  query: string,
  limit: number,
): Promise<GoogleGeocodeResponse> => {
  const lang = await getLanguage();
  const url = `${NOMINATIM_SEARCH}?format=jsonv2&addressdetails=1&q=${encodeURIComponent(query)}&limit=${limit}&accept-language=${lang}`;
  const res = await fetch(url, { headers: NOMINATIM_HEADERS });
  const json = await res.json();

  if (!Array.isArray(json) || json.length === 0) {
    return { status: 'ZERO_RESULTS', results: [] };
  }

  return {
    status: 'OK',
    results: json.map((item: any) => ({
      formatted_address: item.display_name,
      address_components: mapNominatimAddress(item.address),
      geometry: {
        location: { lat: parseFloat(item.lat), lng: parseFloat(item.lon) },
      },
      place_id: item.place_id?.toString(),
    })),
  };
};

const googleSearch = async (
  query: string,
): Promise<GoogleGeocodeResponse> => {
  const url = `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(query)}&key=${GOOGLE_KEY}`;
  const res = await fetch(url);
  return res.json();
};

export const geocodeAddress = async (
  query: string,
): Promise<GoogleGeocodeResponse> => {
  if (!query) {
    return { status: 'ZERO_RESULTS', results: [] };
  }
  if (getMapProvider() === 'osm') {
    return nominatimSearch(query, 1);
  }
  return googleSearch(query);
};

const nominatimAutocomplete = async (
  input: string,
  location?: { latitude?: number; longitude?: number },
): Promise<GoogleAutocompleteResponse> => {
  const lang = await getLanguage();
  let url = `${NOMINATIM_SEARCH}?format=jsonv2&addressdetails=1&q=${encodeURIComponent(input)}&limit=5&accept-language=${lang}`;
  if (location?.latitude != null && location?.longitude != null) {
    url += `&lat=${location.latitude}&lon=${location.longitude}`;
  }
  const res = await fetch(url, { headers: NOMINATIM_HEADERS });
  const json = await res.json();

  if (!Array.isArray(json) || json.length === 0) {
    return { status: 'ZERO_RESULTS', predictions: [] };
  }

  const predictions: GooglePrediction[] = json.map((item: any) => {
    const main = item.address?.road || item.name || item.display_name.split(',')[0] || '';
    const secondary = item.display_name.replace(`${main}, `, '');
    return {
      description: item.display_name,
      place_id: item.place_id?.toString(),
      structured_formatting: {
        main_text: main,
        secondary_text: secondary,
      },
      latitude: parseFloat(item.lat),
      longitude: parseFloat(item.lon),
    };
  });

  return { status: 'OK', predictions };
};

const googleAutocomplete = async (
  input: string,
  location?: { latitude?: number; longitude?: number; radius?: number },
): Promise<GoogleAutocompleteResponse> => {
  let url = `https://maps.googleapis.com/maps/api/place/autocomplete/json?input=${encodeURIComponent(input)}&key=${GOOGLE_KEY}&types=geocode`;
  if (location?.latitude != null && location?.longitude != null) {
    url += `&location=${location.latitude},${location.longitude}&radius=${location.radius || 5000}`;
  }
  const res = await fetch(url);
  return res.json();
};

export const autocompletePlaces = async (
  input: string,
  location?: { latitude?: number; longitude?: number; radius?: number },
): Promise<GoogleAutocompleteResponse> => {
  if (!input || input.trim().length < 3) {
    return { status: 'ZERO_RESULTS', predictions: [] };
  }
  if (getMapProvider() === 'osm') {
    return nominatimAutocomplete(input, location);
  }
  return googleAutocomplete(input, location);
};
