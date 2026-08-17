import React, { useEffect, useRef, useState, useCallback, useMemo } from "react";
import { View, Text, TextInput, TouchableOpacity, Image, ActivityIndicator, Alert, Keyboard } from "react-native";
import { WebView } from 'react-native-webview';
import { useNavigation, useRoute } from "@react-navigation/native";
import { Back, Target, AddressMarker, Search, Locate } from "@src/utils/icons";
import { appColors } from "@src/themes";
import Images from "@utils/images";
import styles from "./styles";
import { useValues } from "@src/utils/context/index";
import { external } from "@src/styles/externalStyle";
import { useSelector } from "react-redux";
import { setValue } from "@src/utils/localstorage";
import useSmartLocation from "@src/components/helper/locationHelper";
import { reverseGeocode, autocompletePlaces, geocodeAddress } from "@src/components/helper/geocoder";

// Define route params interface
interface RouteParams {
  field?: string;
  screenValue?: string;
  service_ID?: string;
  service_name?: string;
  service_category_ID?: string;
  service_category_slug?: string;
  formattedDate?: string;
  formattedTime?: string;
}

// Memoized components to prevent unnecessary re-renders
const BackButton = React.memo(({ onPress, isDark }: { onPress: () => void; isDark: boolean }) => (
  <TouchableOpacity
    onPress={onPress}
    style={[styles.backView, { backgroundColor: isDark ? appColors.darkPrimary : appColors.whiteColor }]}
  >
    <Back />
  </TouchableOpacity>
));

const MapPointer = React.memo(({ pinImage }: { pinImage: any }) => (
  <View style={styles.pointerMarker} pointerEvents="none">
    <Image source={pinImage} style={styles.pinImage} />
  </View>
));

const AddressInput = React.memo(({
  fetchingAddress,
  currentAddress,
  isDark,
  viewRTLStyle,
  searchQuery,
  onChangeSearch,
  onClearSearch,
  suggestions,
  onSelectSuggestion,
  onConfirmSuggestion,
}: {
  fetchingAddress: boolean;
  currentAddress: string;
  isDark: boolean;
  viewRTLStyle: "row" | "row-reverse";
  searchQuery: string;
  onChangeSearch: (text: string) => void;
  onClearSearch: () => void;
  suggestions: any[];
  onSelectSuggestion: (item: any) => void;
  onConfirmSuggestion: () => void;
}) => (
  <View style={styles.searchContainer}>
    <View style={[styles.textInputContainer, { backgroundColor: isDark ? appColors.darkPrimary : appColors.whiteColor, flexDirection: viewRTLStyle }]}>
      <View style={[styles.addressBtnView, { backgroundColor: isDark ? appColors.bgDark : appColors.lightGray }]}>
        <Search />
      </View>
      <TextInput
        style={[styles.textInput, { color: isDark ? appColors.whiteColor : appColors.blackColor }]}
        value={searchQuery}
        onChangeText={onChangeSearch}
        editable={true}
        multiline
        placeholder={fetchingAddress ? "Locating..." : "Search for an address"}
        placeholderTextColor={isDark ? appColors.blackColor : "#999"}
        autoCorrect={false}
      />
      {searchQuery.length > 0 && (
        <TouchableOpacity onPress={onClearSearch} style={styles.clearSearchBtn} hitSlop={{ top: 10, bottom: 10, left: 10, right: 10 }}>
          <Text style={{ fontSize: 18, color: isDark ? appColors.whiteColor : appColors.blackColor }}>×</Text>
        </TouchableOpacity>
      )}
    </View>
    <View style={[styles.currentAddressHint, { backgroundColor: isDark ? appColors.darkPrimary : appColors.whiteColor }]}>
      <AddressMarker />
      <Text
        numberOfLines={2}
        style={[styles.currentAddressText, { color: isDark ? appColors.whiteColor : appColors.blackColor }]}
      >
        {fetchingAddress ? "Locating..." : currentAddress || "Move map to select location"}
      </Text>
    </View>
    {suggestions.length > 0 && (
      <View style={[styles.suggestionContainer, { backgroundColor: isDark ? appColors.darkPrimary : appColors.whiteColor }]}>
        {suggestions.map((item: any, index: number) => (
          <TouchableOpacity
            key={`${item.place_id || item.shortAddress}-${index}`}
            style={styles.suggestionItem}
            onPress={() => onSelectSuggestion(item)}
          >
            <View style={styles.suggestionIcon}>
              <Search />
            </View>
            <View style={styles.suggestionBody}>
              <Text numberOfLines={1} style={[styles.suggestionShort, { color: isDark ? appColors.whiteColor : appColors.blackColor }]}>
                {item.shortAddress}
              </Text>
              <Text numberOfLines={1} style={styles.suggestionDetail}>
                {item.detailAddress}
              </Text>
            </View>
            {item.distance && (
              <Text style={styles.suggestionDistance}>{item.distance}</Text>
            )}
          </TouchableOpacity>
        ))}
        <TouchableOpacity style={styles.suggestionItem} onPress={onConfirmSuggestion}>
          <View style={styles.suggestionIcon}>
            <Locate />
          </View>
          <View style={styles.suggestionBody}>
            <Text numberOfLines={1} style={[styles.suggestionShort, { color: isDark ? appColors.whiteColor : appColors.blackColor }]}>
              Use current map location
            </Text>
            <Text numberOfLines={2} style={styles.suggestionDetail}>
              {currentAddress}
            </Text>
          </View>
        </TouchableOpacity>
      </View>
    )}
  </View>
));

const ConfirmButton = React.memo(({
  onPress,
  fetchingAddress,
  loadingMap,
  currentAddress,
  translateData
}: {
  onPress: () => void;
  fetchingAddress: boolean;
loadingMap: boolean;
      currentAddress: string;
      translateData: any;
}) => (
  <TouchableOpacity
    style={styles.confirmButton}
    onPress={onPress}
    disabled={fetchingAddress || loadingMap}
    activeOpacity={0.8}
  >
    {fetchingAddress ? (
      <ActivityIndicator size="large" color={appColors.whiteColor} />
    ) : (
      <View style={styles.confirmButtonContent}>
        <Target color={appColors.whiteColor} />
        <Text style={styles.confirmText}>
          {translateData.confirmLocation || "Confirmer cet emplacement"}
        </Text>
      </View>
    )}
  </TouchableOpacity>
));

export function LocationSelect() {
  const { isDark, viewRTLStyle, Google_Map_Key } = useValues();
  const webViewRef = useRef<any>(null);
  const navigation = useNavigation();
  const route = useRoute();
  const { field, screenValue, service_ID, service_name, service_category_ID, service_category_slug, formattedDate, formattedTime } = (route.params || {}) as RouteParams;
  const { currentLatitude, currentLongitude } = useSmartLocation();
  const [initialCoords, setInitialCoords] = useState<{ latitude: number; longitude: number } | null>(null);
  const [mapCenterCoords, setMapCenterCoords] = useState<{ latitude: number; longitude: number } | null>(null);
  const [currentAddress, setCurrentAddress] = useState("");
  const [loadingMap, setLoadingMap] = useState(true);
  const [fetchingAddress, setFetchingAddress] = useState(false);
  const debounceTimerRef = useRef<ReturnType<typeof setInterval> | null>(null);
  const [searchQuery, setSearchQuery] = useState("");
  const [suggestions, setSuggestions] = useState<any[]>([]);
  const searchTimeoutRef = useRef<ReturnType<typeof setTimeout> | null>(null);
  const [suggestionsLoading, setSuggestionsLoading] = useState(false);
  const { translateData, taxidoSettingData } = useSelector((state: any) => state.setting);
  const mapType = taxidoSettingData?.cabbooking_values?.location?.map_provider;

  useEffect(() => {
    const lat = currentLatitude;
    const lon = currentLongitude;

    if (lat && lon) {
      const coords = { latitude: lat, longitude: lon };
      setInitialCoords(coords);
      setMapCenterCoords(coords);
      setLoadingMap(false);
    } else {
      // Fallback if location is not detected immediately
      const timer = setTimeout(() => {
        const fallbackCoords = { latitude: 37.78825, longitude: -122.4324 }; // Default to SF if GPS fails
        setInitialCoords(fallbackCoords);
        setMapCenterCoords(fallbackCoords);
        setLoadingMap(false);
      }, 3000);
      return () => clearTimeout(timer);
    }
  }, [currentLatitude, currentLongitude]);

  // Memoize fetchAddress to prevent recreation
  const fetchAddress = useCallback(async (lat: number, lng: number) => {
    setFetchingAddress(true);
    try {
      const json = await reverseGeocode(lat, lng);

      if (json.status === 'OK' && json.results?.length > 0) {
        const bestResult = json.results[0];
        const cleanedAddress = bestResult?.formatted_address;
        setCurrentAddress(cleanedAddress);
      } else {
        console.warn("[fetchAddress] Geocoding API returned no results:", json.status);
        setCurrentAddress("Could not find address for this location.");
      }

    } catch (error) {
      console.error("[fetchAddress] Failed to fetch address:", error);
      setCurrentAddress("Failed to connect to address service.");
    } finally {
      setFetchingAddress(false);
    }
  }, []);

  useEffect(() => {
    if (mapCenterCoords) {
      if (debounceTimerRef?.current) clearTimeout(debounceTimerRef?.current);

      debounceTimerRef.current = setTimeout(() => {
        fetchAddress(mapCenterCoords?.latitude, mapCenterCoords?.longitude);
      }, 800);
    }
    return () => {
      if (debounceTimerRef?.current) clearTimeout(debounceTimerRef?.current);
    };
  }, [mapCenterCoords, fetchAddress]);

  const handleWebViewMessage = useCallback((event: any) => {
    const data = JSON.parse(event?.nativeEvent?.data);
    if (data?.type === 'mapMove') {
      const { lat, lng } = data?.payload;
      setMapCenterCoords({ latitude: lat, longitude: lng });
    }
  }, []);

  const moveMapTo = useCallback((latitude: number, longitude: number) => {
    if (!webViewRef.current) return;
    const js = `if (window.moveMapCenter) { window.moveMapCenter(${latitude}, ${longitude}); } true;`;
    webViewRef.current.injectJavaScript(js);
    setMapCenterCoords({ latitude, longitude });
  }, []);

  const fetchAddressSuggestions = useCallback((query: string) => {
    if (searchTimeoutRef.current) clearTimeout(searchTimeoutRef.current);

    if (!query || query.trim().length < 3) {
      setSuggestions([]);
      return;
    }

    searchTimeoutRef.current = setTimeout(async () => {
      setSuggestionsLoading(true);
      try {
        const location =
          currentLatitude != null && currentLongitude != null
            ? { latitude: currentLatitude, longitude: currentLongitude }
            : undefined;
        const data: any = await autocompletePlaces(query, location);
        if (data?.status === 'OK' && data.predictions?.length) {
          const list = data.predictions.map((item: any) => ({
            place_id: item.place_id,
            shortAddress: item.structured_formatting?.main_text || item.description,
            detailAddress: item.structured_formatting?.secondary_text || '',
            distance: item.distance_meters != null
              ? `${(item.distance_meters / 1000).toFixed(1)} km`
              : undefined,
            latitude: item.latitude,
            longitude: item.longitude,
          }));
          setSuggestions(list);
        } else {
          setSuggestions([]);
        }
      } catch (error) {
        console.error("[LocationSelect] autocomplete failed:", error);
        setSuggestions([]);
      } finally {
        setSuggestionsLoading(false);
      }
    }, 300);
  }, [mapType, currentLatitude, currentLongitude]);

  const handleSelectSuggestion = useCallback(async (item: any) => {
    Keyboard.dismiss();
    setSuggestions([]);
    setSearchQuery(item.shortAddress);

    let lat: number | undefined = item.latitude;
    let lng: number | undefined = item.longitude;

    if (lat == null || lng == null) {
      try {
        const searchTerm = item.detailAddress
          ? `${item.shortAddress}, ${item.detailAddress}`
          : item.shortAddress;
        const geocodeResult = await geocodeAddress(searchTerm);
        if (geocodeResult.status === 'OK' && geocodeResult.results?.length > 0) {
          lat = geocodeResult.results[0].geometry.location.lat;
          lng = geocodeResult.results[0].geometry.location.lng;
        }
      } catch (error) {
        console.error("[LocationSelect] geocode failed:", error);
      }
    }

    if (lat != null && lng != null) {
      moveMapTo(lat, lng);
    } else {
      Alert.alert(translateData.locationNotReady, translateData.locationDescription);
    }
  }, [moveMapTo, translateData]);

  const handleConfirmSuggestion = useCallback(() => {
    Keyboard.dismiss();
    setSuggestions([]);
    if (mapCenterCoords) {
      fetchAddress(mapCenterCoords.latitude, mapCenterCoords.longitude);
    }
  }, [mapCenterCoords, fetchAddress]);

  const handleChangeSearch = useCallback((text: string) => {
    setSearchQuery(text);
    fetchAddressSuggestions(text);
  }, [fetchAddressSuggestions]);

  const handleClearSearch = useCallback(() => {
    setSearchQuery("");
    setSuggestions([]);
    if (searchTimeoutRef.current) clearTimeout(searchTimeoutRef.current);
  }, []);

  const handleConfirmLocation = useCallback(async () => {
    if (!mapCenterCoords) {
      Alert.alert(translateData.locationNotReady, translateData.locationDescription);
      return;
    }
    // If address not ready yet, fetch it now
    if (!currentAddress || fetchingAddress) {
      if (mapCenterCoords) {
        await fetchAddress(mapCenterCoords.latitude, mapCenterCoords.longitude);
      }
      if (!currentAddress) {
        Alert.alert(translateData.locationNotReady, translateData.locationDescription);
        return;
      }
    }
    if (screenValue === "HomeScreen") {
      await setValue('user_latitude_Selected', mapCenterCoords?.latitude.toString());
      await setValue('user_longitude_Selected', mapCenterCoords?.longitude.toString());
      (navigation as any).replace("MyTabs");
      return;
    }
    (navigation as any).navigate(screenValue, {
      selectedAddress: currentAddress,
      fieldValue: field,
      pinLatitude: mapCenterCoords?.latitude,
      pinLongitude: mapCenterCoords?.longitude,
      service_ID,
      service_name,
      service_category_ID,
      service_category_slug,
      formattedDate,
      formattedTime,
    });
  }, [currentAddress, mapCenterCoords, fetchingAddress, screenValue, field, navigation, service_ID, service_name, service_category_ID, service_category_slug, formattedDate, formattedTime]);

  const getMapHTML = useCallback((coords: { latitude: number; longitude: number }, mapType: string, isDark: boolean) => {
    if (mapType === 'osm') {
      const darkTileUrl = 'https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png';
      const lightTileUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
      const tileUrl = isDark ? darkTileUrl : lightTileUrl;

      return `
      <!DOCTYPE html>
      <html>
      <head>
          <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
          <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
          <style>
            body, html, #map {
              margin: 0;
              padding: 0;
              height: 100%;
              width: 100%;
              background-color: ${isDark ? appColors.blackColor : appColors.whiteColor};
            }
          </style>
      </head>
      <body>
          <div id="map"></div>
          <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
          <script>
              function initMap() {
                  const map = L.map('map', {
                      center: [${coords?.latitude}, ${coords?.longitude}],
                      zoom: 16,
                      zoomControl: false
                  });

                  L.tileLayer('${tileUrl}', {
                      attribution: '© OpenStreetMap contributors'
                  }).addTo(map);

                  map.on('moveend', function() {
                      const center = map.getCenter();
                      const message = {
                          type: 'mapMove',
                          payload: { lat: center.lat, lng: center.lng }
                      };
                      window.ReactNativeWebView.postMessage(JSON.stringify(message));
                  });

                  window.moveMapCenter = function(lat, lng) {
                      map.setView([lat, lng], map.getZoom());
                  };
              }
              initMap();
          </script>
      </body>
      </html>
    `;
    }

    // Google Maps implementation (existing code)
    const darkTheme = [
      { elementType: "geometry", stylers: [{ color: "#212121" }] },
      { elementType: "labels.icon", stylers: [{ visibility: "off" }] },
      { elementType: "labels.text.fill", stylers: [{ color: "#757575" }] },
      { elementType: "labels.text.stroke", stylers: [{ color: "#212121" }] },
      {
        featureType: "administrative",
        elementType: "geometry",
        stylers: [{ color: "#757575" }]
      },
      {
        featureType: "poi",
        elementType: "geometry",
        stylers: [{ color: "#282828" }]
      },
      {
        featureType: "poi.park",
        elementType: "geometry",
        stylers: [{ color: "#181818" }]
      },
      {
        featureType: "road",
        elementType: "geometry.fill",
        stylers: [{ color: "#2c2c2c" }]
      },
      {
        featureType: "road",
        elementType: "labels.text.fill",
        stylers: [{ color: "#8a8a8a" }]
      },
      {
        featureType: "transit",
        elementType: "geometry",
        stylers: [{ color: "#2f2f2f" }]
      },
      {
        featureType: "water",
        elementType: "geometry",
        stylers: [{ color: "#000000" }]
      },
      {
        featureType: "water",
        elementType: "labels.text.fill",
        stylers: [{ color: "#3d3d3d" }]
      }
    ];

    const mapThemeStyles = isDark ? darkTheme : [];
    return `
    <!DOCTYPE html>
    <html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <style>
          body, html, #map {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            background-color: ${isDark ? "#000" : "#fff"};
          }
        </style>
    </head>
    <body>
        <div id="map"></div>
        <script>
            function initMap() {
                const map = new google.maps.Map(document.getElementById('map'), {
                    center: { lat: ${coords?.latitude}, lng: ${coords?.longitude} },
                    zoom: 16,
                    disableDefaultUI: true,
                    styles: ${JSON.stringify(mapThemeStyles)}
                });

                map.addListener('idle', () => {
                    const center = map.getCenter();
                    const message = {
                        type: 'mapMove',
                        payload: { lat: center.lat(), lng: center.lng() }
                    };
                    window.ReactNativeWebView.postMessage(JSON.stringify(message));
                });

                window.moveMapCenter = function(lat, lng) {
                    map.panTo({ lat: lat, lng: lng });
                };
            }
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=${Google_Map_Key}&callback=initMap"></script>
    </body>
    </html>
  `;
  }, [Google_Map_Key]);

  // Memoize the WebView source to prevent unnecessary reloads
  const webViewSource = useMemo(() => {
    return initialCoords ? { html: getMapHTML(initialCoords, mapType, isDark) } : { html: '' };
  }, [initialCoords, getMapHTML, mapType, isDark]);

  // Memoize loading state component
  const loadingComponent = useMemo(() => (
    <View style={styles.loaderContainer}>
      <ActivityIndicator size="large" color={appColors.primary} />
    </View>
  ), []);

  return (
    <View style={external.main}>
      <BackButton onPress={() => navigation.goBack()} isDark={isDark} />

      {loadingMap ? (
        loadingComponent
      ) : initialCoords ? (
        <>
          <WebView
            ref={webViewRef}
            style={styles.mapView}
            source={webViewSource}
            onMessage={handleWebViewMessage}
            javaScriptEnabled
            domStorageEnabled
            originWhitelist={['*']}
            scrollEnabled={false}
            showsHorizontalScrollIndicator={false}
            showsVerticalScrollIndicator={false}
          />
          <MapPointer pinImage={Images.pin} />
        </>
      ) : (
        loadingComponent
      )}

      <AddressInput
        fetchingAddress={fetchingAddress}
        currentAddress={currentAddress}
        isDark={isDark}
        viewRTLStyle={viewRTLStyle}
        searchQuery={searchQuery}
        onChangeSearch={handleChangeSearch}
        onClearSearch={handleClearSearch}
        suggestions={suggestions}
        onSelectSuggestion={handleSelectSuggestion}
        onConfirmSuggestion={handleConfirmSuggestion}
      />

      <ConfirmButton
        onPress={handleConfirmLocation}
        fetchingAddress={fetchingAddress}
        loadingMap={loadingMap}
        currentAddress={currentAddress}
        translateData={translateData}
      />
    </View>
  );
}