import { View, Text, ScrollView, TouchableOpacity } from 'react-native'
import React, { useRef, useState } from 'react'
import { Add, Back, Location, Swap } from '@src/utils/icons'
import { appColors } from '@src/themes'
import { HomeSlider } from '@src/components'
import { TextInput } from 'react-native-gesture-handler'
import { styles } from './styles'
import { Button, LineContainer } from '@src/commonComponent'
import { useAppNavigation } from '@src/utils/navigation'
import MapView, { Marker } from 'react-native-maps'
import MapViewDirections from 'react-native-maps-directions'
import { useValues } from '@src/utils/context/index';
import useStoredLocation from '@src/components/helper/useStoredLocation'


export function CarpoolingHome() {
    const [isScrolling, setIsScrolling] = useState(true);
    const { navigate, goBack } = useAppNavigation();
    const { viewRTLStyle, Google_Map_Key } = useValues()
    const mapRef = useRef(null);
    const { latitude, longitude } = useStoredLocation();
    const [pickupCoords, setPickupCoords] = useState<{ lat: number; lng: number } | null>(null);
    const [dropOffCoords, setDropOffCoords] = useState<{ lat: number; lng: number } | null>(null);
    const [pickupText, setPickupText] = useState('');
    const [dropoffText, setDropoffText] = useState('');

    const userLat = latitude || 37.7749;
    const userLng = longitude || -122.4194;

    const handleSwapLocations = () => {
        setPickupCoords(prev => {
            setDropOffCoords(prev);
            return dropOffCoords;
        });
        setPickupText(prev => {
            setDropoffText(prev);
            return dropoffText;
        });
    };

    return (
        <View style={styles.mainView}>
            <View style={styles.headerView}>
                <TouchableOpacity onPress={goBack} activeOpacity={0.7} style={styles.back}>
                    <Back />
                </TouchableOpacity>
                <Text style={styles.headerText}>Carpooling</Text>
                <TouchableOpacity onPress={() => navigate('PublishRide')} activeOpacity={0.7} style={styles.add}>
                    <Add colors={appColors.primaryText} />
                </TouchableOpacity>
            </View>

            <View style={styles.mapContainer}>
                <ScrollView showsVerticalScrollIndicator={false}>
                    <View style={styles.mapView}>
                        <MapView
                            ref={mapRef}
                            style={styles.map}
                            initialRegion={{
                                latitude: userLat,
                                longitude: userLng,
                                latitudeDelta: 0.05,
                                longitudeDelta: 0.05
                            }}
                            showsUserLocation={true}
                        >
                            {pickupCoords && (
                                <Marker
                                    coordinate={{ latitude: pickupCoords.lat, longitude: pickupCoords.lng }}
                                    title="Pickup"
                                    pinColor={appColors.primary}
                                />
                            )}
                            {dropOffCoords && (
                                <Marker
                                    coordinate={{ latitude: dropOffCoords.lat, longitude: dropOffCoords.lng }}
                                    title="Drop-off"
                                    pinColor="red"
                                />
                            )}
                            {pickupCoords && dropOffCoords && (
                                <MapViewDirections
                                    origin={{ latitude: pickupCoords.lat, longitude: pickupCoords.lng }}
                                    destination={{ latitude: dropOffCoords.lat, longitude: dropOffCoords.lng }}
                                    apikey={Google_Map_Key}
                                    strokeWidth={4}
                                    strokeColor={appColors.primary}
                                />
                            )}
                        </MapView>
                    </View>
                    <View style={styles.view}>
                        <View style={styles.rideView}>
                            <TouchableOpacity style={styles.searchRideView} onPress={() => navigate('RideList')}>
                                <Text style={styles.searchRide}>Search Ride</Text>
                            </TouchableOpacity>
                            <TouchableOpacity style={styles.createRideView} onPress={() => navigate('PublishRide')}>
                                <Text style={styles.createRide}>Create Ride</Text>
                            </TouchableOpacity>
                        </View>
                        <View style={styles.lineContainer}>
                            <LineContainer />
                        </View>
                        <View style={styles.locationMainView}>
                            <View style={styles.locationView}>
                                <View style={styles.inputBox}>
                                    <View style={styles.iconContainer}>
                                        <Location />
                                    </View>
                                    <TextInput
                                        placeholder="Pickup Location"
                                        placeholderTextColor={appColors.gray}
                                        value={pickupText}
                                        onChangeText={setPickupText}
                                        onFocus={() => {
                                            if (latitude && longitude) {
                                                setPickupCoords({ lat: latitude, lng: longitude });
                                                setPickupText('Current Location');
                                            }
                                        }}
                                    />
                                </View>
                                <View style={styles.inputBox}>
                                    <View style={styles.iconContainer}>
                                        <Location />
                                    </View>
                                    <TextInput
                                        placeholder="Drop-off Location"
                                        style={styles.input}
                                        placeholderTextColor={appColors.gray}
                                        value={dropoffText}
                                        onChangeText={setDropoffText}
                                        onFocus={() => {
                                            if (latitude && longitude) {
                                                setDropOffCoords({ lat: latitude + 0.01, lng: longitude + 0.01 });
                                                setDropoffText('Selected Destination');
                                            }
                                        }}
                                    />
                                </View>

                                <TouchableOpacity style={styles.swapButton} activeOpacity={0.7} onPress={handleSwapLocations}>
                                    <Swap />
                                </TouchableOpacity>
                            </View>
                            <View style={styles.buttonView}>
                                <Button
                                    textColor={appColors.whiteColor}
                                    title='Search Rides'
                                    onPress={() => navigate('RideList', {
                                        pickupLat: pickupCoords?.lat,
                                        pickupLng: pickupCoords?.lng,
                                        dropoffLat: dropOffCoords?.lat,
                                        dropoffLng: dropOffCoords?.lng,
                                    })}
                                />
                            </View>
                        </View>

                        <View style={styles.slider}>
                            <HomeSlider
                                onSwipeStart={() => setIsScrolling(false)}
                                onSwipeEnd={() => setIsScrolling(true)}
                            />
                        </View>
                    </View>
                </ScrollView>
            </View>
        </View>
    )
}
