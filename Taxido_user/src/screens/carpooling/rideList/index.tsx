import React, { useState, useEffect, useCallback } from "react";
import { ActivityIndicator, Image, Text, TouchableOpacity, View } from "react-native";
import styles from "./styles";
import { appColors, appFonts, fontSizes } from "@src/themes";
import { Back, CalenderSmall, ClockSmall, Filter, Message, RatingEmptyStart, RatingStar, RightArrow, SafetyCall, Seat1 } from "@src/utils/icons";
import { useNavigation, useTheme } from "@react-navigation/native";
import { useAppNavigation, useAppRoute } from "@src/utils/navigation";
import Images from "@src/utils/images";
import { carpoolingOfferService } from "@src/api/services";

interface CarpoolingOffer {
    id: number;
    driver_id: number;
    vehicle_type_id: number;
    total_seats: number;
    available_seats: number;
    discount: string | null;
    start_date: string | null;
    end_date: string | null;
    pickup_location: string | null;
    dropoff_location: string | null;
    available_area: string | null;
    is_active: boolean;
    driver: {
        id: number;
        name: string;
        profile_image_url: string | null;
        rating_count: number;
        review_count: number;
    } | null;
    vehicle_type: {
        id: number;
        name: string;
        max_seat: number;
    } | null;
}

export function RideList() {
    const navigation = useNavigation()
    const { navigate, goBack } = useAppNavigation();
    const { params } = useAppRoute<'RideList'>();
    const { colors } = useTheme()
    const [offers, setOffers] = useState<CarpoolingOffer[]>([])
    const [loading, setLoading] = useState(true)
    const [error, setError] = useState<string | null>(null)

    const fetchOffers = useCallback(async () => {
        try {
            setLoading(true)
            setError(null)
            const searchParams: any = {};
            if (params?.pickupLat) searchParams.pickup_lat = params.pickupLat;
            if (params?.pickupLng) searchParams.pickup_lng = params.pickupLng;
            if (params?.dropoffLat) searchParams.dropoff_lat = params.dropoffLat;
            if (params?.dropoffLng) searchParams.dropoff_lng = params.dropoffLng;

            const response = await carpoolingOfferService.searchCarpoolingOffers(searchParams);
            if (response?.data?.success) {
                setOffers(response.data.data || [])
            } else {
                setOffers([])
            }
        } catch (err) {
            setError('Failed to load offers')
            setOffers([])
        } finally {
            setLoading(false)
        }
    }, [])

    useEffect(() => {
        fetchOffers()
    }, [fetchOffers])

    const handleOfferPress = (offer: CarpoolingOffer) => {
        navigate('CarpoolingRideDetails', { offerId: offer.id, offer })
    }

    const formatDate = (dateString: string | null) => {
        if (!dateString) return 'Flexible'
        const date = new Date(dateString)
        return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })
    }

    return (
        <View style={styles.mainContainer}>
            <View style={styles.headerMainView}>
                <TouchableOpacity onPress={goBack} activeOpacity={0.7} style={styles.back}>
                    <Back />
                </TouchableOpacity>
                <Text style={styles.hedaerText}>Available Rides</Text>
                <TouchableOpacity activeOpacity={0.7} style={styles.back}>
                    <Filter />
                </TouchableOpacity>
            </View>

            {loading ? (
                <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center' }}>
                    <ActivityIndicator size="large" color={appColors.primary} />
                    <Text style={{ marginTop: 10, color: appColors.gray }}>Loading rides...</Text>
                </View>
            ) : error ? (
                <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center', padding: 20 }}>
                    <Text style={{ color: appColors.gray, textAlign: 'center' }}>{error}</Text>
                    <TouchableOpacity onPress={fetchOffers} style={{ marginTop: 10 }}>
                        <Text style={{ color: appColors.primary }}>Retry</Text>
                    </TouchableOpacity>
                </View>
            ) : offers.length === 0 ? (
                <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center', padding: 20 }}>
                    <Text style={{ color: appColors.gray, textAlign: 'center' }}>
                        No carpooling rides available right now.{'\n'}Check back later!
                    </Text>
                </View>
            ) : (
                offers.map((offer) => (
                    <TouchableOpacity
                        key={offer.id}
                        style={styles.dataView}
                        activeOpacity={0.7}
                        onPress={() => handleOfferPress(offer)}
                    >
                        <View style={styles.viewData}>
                            <Image
                                source={offer.driver?.profile_image_url ? { uri: offer.driver.profile_image_url } : Images.defultImage}
                                style={styles.image}
                            />

                            <View style={styles.dataView1}>
                                <Text style={styles.name}>
                                    {offer.driver?.name || 'Driver'}
                                </Text>

                                <View style={styles.starView}>
                                    {Array.from({ length: Math.min(5, Math.round(offer.driver?.rating_count || 0)) }).map((_, index) => (
                                        <RatingStar key={index} />
                                    ))}
                                    <Text style={styles.starNumber}>
                                        {(offer.driver?.rating_count || 0).toFixed(1)}
                                    </Text>
                                    <Text style={styles.digit}>
                                        ({offer.driver?.review_count || 0})
                                    </Text>
                                </View>
                            </View>

                            <View style={styles.view}>
                                <TouchableOpacity
                                    style={[styles.MessageView, { borderColor: colors.border }]}
                                    activeOpacity={0.7}
                                >
                                    <Message />
                                </TouchableOpacity>
                                <TouchableOpacity
                                    activeOpacity={0.7}
                                    style={[styles.safetyCallView, { borderColor: colors.border }]}
                                >
                                    <SafetyCall color={appColors.primary} />
                                </TouchableOpacity>
                            </View>
                        </View>

                        <View style={styles.dashedLine} />
                        <View style={styles.carView}>
                            <Text style={styles.toyotaText}>
                                {offer.vehicle_type?.name || 'Vehicle'}
                            </Text>
                            <View style={styles.seatMainView}>
                                <View style={styles.seatView}>
                                    <Seat1 />
                                    <Text style={styles.seatText}>
                                        {offer.available_seats} Seat{offer.available_seats !== 1 ? 's' : ''}
                                    </Text>
                                </View>
                            </View>
                        </View>
                        <View style={styles.dashedLine} />

                        <View style={styles.dataView2}>
                            <Text style={styles.torontoText}>
                                {offer.pickup_location || 'Pickup'}
                            </Text>

                            <View style={styles.rightArrow}>
                                <RightArrow />
                            </View>

                            <Text style={styles.calgaryText}>
                                {offer.dropoff_location || 'Drop-off'}
                            </Text>
                            <View style={styles.calenderSmall}>
                                <CalenderSmall />
                            </View>
                            <Text style={styles.dateAndYear}>
                                {formatDate(offer.start_date)}
                            </Text>
                        </View>
                        <View style={styles.bottomView}>
                            {offer.discount ? (
                                <Text style={{
                                    color: appColors.primary,
                                    fontSize: fontSizes.FONT20,
                                    fontFamily: appFonts.semiBold,
                                }}>
                                    {offer.discount}% OFF
                                </Text>
                            ) : (
                                <Text style={{
                                    color: appColors.primary,
                                    fontSize: fontSizes.FONT20,
                                    fontFamily: appFonts.semiBold,
                                }}>
                                    Available
                                </Text>
                            )}

                            <View style={styles.clockSmall}>
                                <ClockSmall />
                                <Text style={styles.time}>
                                    {offer.available_seats} seat{offer.available_seats !== 1 ? 's' : ''} left
                                </Text>
                            </View>
                        </View>
                    </TouchableOpacity>
                ))
            )}
        </View>
    )
}
