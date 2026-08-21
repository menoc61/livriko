import { Button, Header, RadioButton } from "@src/commonComponent";
import { appColors } from "@src/themes";
import { CloseCircle, Gps, IdCard, Message, PickLocation, Radio, RatingEmptyStart, RatingStar, Report, ShareRide, Toyota } from "@src/utils/icons";
import React, { useState, useEffect } from "react";
import { ActivityIndicator, Alert, Image, Modal, Text, TextInput, TouchableOpacity, View } from "react-native";
import styles from "./styles";
import { useTheme } from "@react-navigation/native";
import Images from "@src/utils/images";
import { ScrollView } from "react-native-gesture-handler";
import { useAppNavigation, useAppRoute } from "@src/utils/navigation";
import { carpoolingOfferService } from "@src/api/services";

interface OfferData {
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
    preferences: string[] | null;
    driver: {
        id: number;
        name: string;
        profile_image_url: string | null;
        rating_count: number;
        review_count: number;
        phone: string;
        country_code: string;
    } | null;
    vehicle_type: {
        id: number;
        name: string;
        max_seat: number;
    } | null;
}

export function CarpolingRideDetails() {
    const { params } = useAppRoute<'CarpoolingRideDetails'>()
    const { goBack } = useAppNavigation()
    const { colors } = useTheme()

    const [reportModalVisible, setReportModalVisible] = useState(false);
    const [selectedOption, setSelectedOption] = useState<string | null>(null);
    const [selectedOption1, setSelectedOption1] = useState<string | null>(null);
    const [offer, setOffer] = useState<OfferData | null>(params?.offer || null)
    const [loading, setLoading] = useState(!params?.offer)
    const [booking, setBooking] = useState(false)
    const [seatsToBook, setSeatsToBook] = useState(1)

    const reportRideOptions = [
        "Driver didn't show up",
        "Unsafe driving behaviour",
        "Overcharged for the ride",
        "Smoking or strong odors in the car",
        "Loud or disruptive music",
        "Unexpected stops or route changes",
        "Discrimination or harassment",
    ];

    useEffect(() => {
        if (params?.offerId && !offer) {
            fetchOffer(params.offerId)
        }
    }, [params?.offerId])

    const fetchOffer = async (offerId: number) => {
        try {
            setLoading(true)
            const response = await carpoolingOfferService.getCarpoolingOffer(offerId)
            if (response?.data?.success) {
                setOffer(response.data.data)
            }
        } catch (err) {
            console.error('Failed to fetch offer:', err)
        } finally {
            setLoading(false)
        }
    }

    const handleBookNow = async () => {
        if (!offer) return

        try {
            setBooking(true)
            const response = await carpoolingOfferService.bookCarpoolingOffer(offer.id, {
                seats: seatsToBook,
                payment_method: 'cash',
            })

            if (response?.data?.success) {
                Alert.alert('Success', 'Seat booked successfully!')
                goBack()
            } else {
                Alert.alert('Error', response?.data?.message || 'Failed to book seat')
            }
        } catch (err) {
            Alert.alert('Error', 'Failed to book seat. Please try again.')
        } finally {
            setBooking(false)
        }
    }

    const formatDate = (dateString: string | null) => {
        if (!dateString) return 'Flexible'
        const date = new Date(dateString)
        return date.toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' })
    }

    if (loading) {
        return (
            <View style={styles.flexView}>
                <Header value="Ride Details" />
                <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center' }}>
                    <ActivityIndicator size="large" color={appColors.primary} />
                </View>
            </View>
        )
    }

    if (!offer) {
        return (
            <View style={styles.flexView}>
                <Header value="Ride Details" />
                <View style={{ flex: 1, justifyContent: 'center', alignItems: 'center' }}>
                    <Text style={{ color: appColors.gray }}>Offer not found</Text>
                </View>
            </View>
        )
    }

    const cities = [
        { label: offer.pickup_location || 'Pickup Location', type: 'start' },
        ...(offer.available_area ? [{ label: offer.available_area, type: 'middle' }] : []),
        { label: offer.dropoff_location || 'Drop-off Location', type: 'end' },
    ];

    return (
        <View style={styles.flexView}>
            <Header value="Ride Details" />
            <ScrollView showsVerticalScrollIndicator={false}>
                <View style={styles.scrollView}>
                    <View style={styles.citiesView}>
                        <Text style={styles.date}>{formatDate(offer.start_date)}</Text>
                        {cities.map((step, index) => (
                            <View key={index} style={styles.stepContainer}>
                                <View style={styles.iconColumn}>
                                    <View style={styles.iconView}>
                                        {step.type === 'start' && <PickLocation />}
                                        {step.type === 'middle' && <Radio />}
                                        {step.type === 'end' && <Gps />}
                                    </View>
                                    {index !== cities?.length - 1 && <View style={styles.line} />}
                                </View>

                                <TouchableOpacity style={styles.labelColumn}>
                                    <Text style={[
                                        styles.label,
                                        { color: step.type === 'middle' ? appColors.blackColor : appColors.gray }
                                    ]}>
                                        {step.label}
                                    </Text>
                                </TouchableOpacity>
                            </View>
                        ))}
                    </View>
                </View>
                <View style={styles.bottomView}>
                    <View style={styles.bookSeatsView}>
                        <Text style={styles.totalAmountText}>Book Seats</Text>
                        <Text style={styles.price}>{seatsToBook}</Text>
                    </View>
                    <View style={styles.totalAmountView}>
                        <Text style={styles.totalAmountText}>Available Seats</Text>
                        <Text style={styles.price}>{offer.available_seats}</Text>
                    </View>
                </View>
                <View style={styles.userData}>
                    <View style={styles.imageView}>
                        <Image
                            source={offer.driver?.profile_image_url ? { uri: offer.driver.profile_image_url } : Images.defultImage}
                            style={styles.image}
                        />

                        <View style={styles.nameView}>
                            <Text style={styles.Jonathan}>
                                {offer.driver?.name || 'Driver'}
                            </Text>

                            <View style={styles.starView}>
                                {Array.from({ length: Math.min(5, Math.round(offer.driver?.rating_count || 0)) }).map((_, index) => (
                                    <RatingStar key={index} />
                                ))}
                                <Text style={styles.starPoint}>
                                    {(offer.driver?.rating_count || 0).toFixed(1)}
                                </Text>
                                <Text style={styles.digit}>
                                    ({offer.driver?.review_count || 0})
                                </Text>
                            </View>
                        </View>

                        <View style={styles.messageView}>
                            <TouchableOpacity
                                style={[styles.MessageView, { borderColor: colors.border }]}
                                activeOpacity={0.7}
                            >
                                <Message />
                            </TouchableOpacity>
                        </View>
                    </View>
                    <View style={styles.dashedLine1} />
                    <View style={styles.toyotaView}>
                        <Toyota />
                        <Text style={styles.toyota}>{offer.vehicle_type?.name || 'Vehicle'}</Text>
                    </View>
                    <View style={styles.dashedLine1} />

                    {offer.discount && (
                        <View style={{ padding: 10, backgroundColor: '#E8F5E9', borderRadius: 8, marginVertical: 8 }}>
                            <Text style={{ color: appColors.primary, fontWeight: 'bold' }}>
                                {offer.discount}% Discount Available
                            </Text>
                        </View>
                    )}

                    <Text style={styles.travel}>Travel Preferences:</Text>
                    {offer.preferences && offer.preferences.length > 0 ? (
                        offer.preferences.map((pref, index) => (
                            <View key={index} style={styles.talkView}>
                                <Text style={styles.dot}>.</Text>
                                <Text style={styles.travelText}>{pref}</Text>
                            </View>
                        ))
                    ) : (
                        <View style={styles.talkView}>
                            <Text style={styles.dot}>.</Text>
                            <Text style={styles.travelText}>No specific preferences</Text>
                        </View>
                    )}
                </View>
                <View style={styles.vieww}>
                    <TouchableOpacity style={styles.rideView} onPress={() => setReportModalVisible(true)}>
                        <Report />
                        <Text style={styles.report}>Report</Text>
                    </TouchableOpacity>
                    <View style={styles.dashedLine2} />

                    <View style={styles.rideView}>
                        <ShareRide />
                        <Text style={styles.report}>Share Ride</Text>
                    </View>
                </View>

                <View style={{ flexDirection: 'row', justifyContent: 'center', alignItems: 'center', marginVertical: 10, gap: 10 }}>
                    <TouchableOpacity
                        onPress={() => seatsToBook > 1 && setSeatsToBook(prev => prev - 1)}
                        style={{ padding: 10, borderWidth: 1, borderColor: appColors.border, borderRadius: 8 }}
                    >
                        <Text style={{ fontSize: 20, color: appColors.primary }}>-</Text>
                    </TouchableOpacity>
                    <Text style={{ fontSize: 18, fontWeight: 'bold' }}>{seatsToBook}</Text>
                    <TouchableOpacity
                        onPress={() => seatsToBook < offer.available_seats && setSeatsToBook(prev => prev + 1)}
                        style={{ padding: 10, borderWidth: 1, borderColor: appColors.border, borderRadius: 8 }}
                    >
                        <Text style={{ fontSize: 20, color: appColors.primary }}>+</Text>
                    </TouchableOpacity>
                </View>

                <View style={styles.button}>
                    <Button
                        title={booking ? "Booking..." : "Book Now"}
                        onPress={handleBookNow}
                    />
                </View>
            </ScrollView>
            <Modal
                transparent={true}
                visible={reportModalVisible}
                animationType="slide"
                onRequestClose={() => setReportModalVisible(false)}
            >
                <View style={styles.modalView}>
                    <View style={styles.viewModal}>
                        <TouchableOpacity
                            style={{ alignSelf: "flex-end" }}
                            onPress={() => setReportModalVisible(false)}
                        >
                            <CloseCircle />
                        </TouchableOpacity>

                        <Text style={styles.reportRideText}>Report Ride</Text>
                        <View style={styles.reportRideOptionsViewMain}>
                            {reportRideOptions.map((item, index) => (
                                <TouchableOpacity
                                    key={index}
                                    style={styles.reportRideOptionsView}
                                    onPress={() => setSelectedOption(item)}
                                >
                                    <Text>{item}</Text>

                                    <RadioButton
                                        color={appColors.primary}
                                        checked={selectedOption1 === item}
                                        onPress={() => setSelectedOption1(item)}
                                    />
                                </TouchableOpacity>
                            ))}
                        </View>

                        <Text style={styles.aboutText}>Tell Us About More</Text>
                        <View style={styles.cardMainView}>
                            <View style={styles.idCardView}>
                                <IdCard />
                            </View>
                            <View>
                                <TextInput
                                    style={styles.textInput}
                                    multiline
                                    numberOfLines={5}
                                    placeholder="Write here...."
                                    placeholderTextColor={appColors.gray}
                                />
                            </View>
                        </View>
                        <View style={styles.textView}>
                            <TouchableOpacity style={styles.cancelTextView} onPress={() => setReportModalVisible(false)}>
                                <Text style={styles.cancelText}>Cancel</Text>
                            </TouchableOpacity>

                            <View style={styles.reportTextView}>
                                <Text style={styles.reportText}>Report</Text>
                            </View>
                        </View>
                    </View>
                </View>
            </Modal>
        </View>
    )
}
