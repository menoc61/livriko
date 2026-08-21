import React, { useState } from 'react'
import { View, Text, TextInput, ScrollView } from 'react-native'
import appColors from '../../../theme/appColors'
import { Switch } from '../appSettings/component/'
import { personValue, totalKM } from './data'
import { DatePicker, Dropdown } from './component/'
import styles from './styles'
import { Input, Button, Header, notificationHelper } from '../../../commonComponents'
import { useTheme } from '@react-navigation/native'
import { useValues } from '../../../utils/context'
import { windowHeight } from '../chat/context'
import { useSelector } from 'react-redux'
import { useNavigation } from '@react-navigation/native'
import { carpoolingOfferService } from '../../../api/services'

export function AddNewOffer() {
  const [startDate, setStartDate] = useState(new Date())
  const [endDate, setEndDate] = useState(new Date())
  const [selectVehicleValue, setselectVehicleValue] = useState<string | null>(null)
  const [selectedValue, setSelectedValue] = useState<string | null>(null)
  const [selectedKMValue, setSelectedKMValue] = useState('1')
  const [isThemeOn, setIsThemeOn] = useState(false)
  const [openVehicle, setOpenVehicle] = useState(false)
  const [open, setOpen] = useState(false)
  const [openKM, setOpenKM] = useState(false)
  const [discount, setDiscount] = useState('')
  const [availableArea, setAvailableArea] = useState('')
  const [pickupLocation, setPickupLocation] = useState('')
  const [dropoffLocation, setDropoffLocation] = useState('')
  const [loading, setLoading] = useState(false)
  const { colors } = useTheme()
  const { viewRtlStyle, textRtlStyle, rtl, isDark } = useValues()
  const { translateData } = useSelector((state: any) => state.setting)
  const { vehicleTypedata } = useSelector((state: any) => state.vehicleType)
  const navigation = useNavigation()

  const handleStartDateChange = (date: Date) => setStartDate(date)
  const handleEndDateChange = (date: Date) => setEndDate(date)
  const handleThemeToggle = () => setIsThemeOn(prevState => !prevState)

  const vehicleTypeItems = (vehicleTypedata || []).map((vt: any) => ({
    label: vt.name || `Vehicle ${vt.id}`,
    value: String(vt.id),
  }))

  const handleSubmit = async () => {
    if (!selectedValue) {
      notificationHelper('', 'Please select number of available seats', 'error')
      return
    }

    setLoading(true)
    try {
      const payload: any = {
        vehicle_type_id: selectVehicleValue ? Number(selectVehicleValue) : null,
        total_seats: Number(selectedValue),
        available_seats: Number(selectedValue),
        discount: discount || null,
        start_date: startDate.toISOString().split('T')[0],
        end_date: endDate.toISOString().split('T')[0],
        available_area: availableArea || null,
        km_range: Number(selectedKMValue),
        is_active: isThemeOn,
      }

      if (pickupLocation) {
        payload.pickup_location = pickupLocation
      }
      if (dropoffLocation) {
        payload.dropoff_location = dropoffLocation
      }

      const response = await carpoolingOfferService.createCarpoolingOffer(payload)

      if (response?.status === 201 || response?.data?.success) {
        notificationHelper('', 'Offer created successfully', 'success')
        navigation.goBack()
      } else {
        const errorMessage = response?.data?.message || 'Failed to create offer'
        notificationHelper('', errorMessage, 'error')
      }
    } catch (error: any) {
      notificationHelper('', error?.message || 'Something went wrong', 'error')
    } finally {
      setLoading(false)
    }
  }

  return (
    <ScrollView
      style={[styles.main, { backgroundColor: colors.background }]}
      showsVerticalScrollIndicator={false}
    >
      <Header title={translateData.titleAddNewOffer || 'Add New Offer'} />
      <View style={[styles.container, { backgroundColor: colors.card }]}>
        <Text
          style={[
            styles.title,
            { color: colors.text, textAlign: textRtlStyle },
          ]}
        >
          {translateData.vehicleType || 'Vehicle Type'}
        </Text>
        <View style={styles.selectDropDownStyle}>
          <Dropdown
            open={openVehicle}
            value={selectVehicleValue}
            items={vehicleTypeItems.length > 0 ? vehicleTypeItems : [{ label: 'Car', value: '3' }]}
            onChange={setselectVehicleValue}
            setOpen={setOpenVehicle}
            zIndex={20}
            placeholderValue={translateData.selectVehicleType || 'Select Vehicle Type'}
            style={[
              {
                borderColor: isDark ? appColors.darkborder : appColors.border,
                flexDirection: viewRtlStyle,
              },
            ]}
            textStyle={{
              textAlign: rtl ? 'right' : 'left',
            }}
          />
        </View>

        <View style={styles.inputFild}>
          <Input
            title="Pickup Location"
            titleShow={true}
            placeholder="Enter pickup location"
            keyboardType="default"
            backgroundColor={colors.card}
            value={pickupLocation}
            onChangeText={setPickupLocation}
          />
        </View>

        <View style={styles.inputFild}>
          <Input
            title="Drop-off Location"
            titleShow={true}
            placeholder="Enter drop-off location"
            keyboardType="default"
            backgroundColor={colors.card}
            value={dropoffLocation}
            onChangeText={setDropoffLocation}
          />
        </View>

        <View style={styles.inputFild}>
          <Input
            title={translateData.discount || 'Discount'}
            titleShow={true}
            placeholder={translateData.enterYourNumber || 'Enter discount percentage'}
            keyboardType="default"
            warning={translateData.enterPhone || 'Enter a valid number'}
            backgroundColor={colors.card}
            value={discount}
            onChangeText={setDiscount}
          />
        </View>
        <View style={{ flexDirection: viewRtlStyle }}>
          <View style={styles.datePickerStyle}>
            <DatePicker
              label={translateData.startDate || 'Start Date'}
              date={startDate}
              onChange={handleStartDateChange}
            />
          </View>
          <View style={styles.datePickerStyle1}>
            <DatePicker
              label={translateData.endDate || 'End Date'}
              date={endDate}
              onChange={handleEndDateChange}
            />
          </View>
        </View>
        <Text
          style={[
            styles.title,
            { color: colors.text, textAlign: textRtlStyle },
            { bottom: windowHeight(9) },
          ]}
        >
          {translateData.availableSeats || 'Available Seats'}
        </Text>
        <View style={styles.selectVehicleStyle}>
          <Dropdown
            open={open}
            value={selectedValue}
            items={personValue}
            onChange={setSelectedValue}
            setOpen={setOpen}
            zIndex={2}
            style={[
              {
                borderColor: isDark ? appColors.darkborder : appColors.border,
                flexDirection: viewRtlStyle,
              },
            ]}
            textStyle={{
              textAlign: rtl ? 'right' : 'left',
            }}
          />
        </View>
        <Text
          style={[
            styles.title,
            { color: colors.text, textAlign: textRtlStyle },
            { bottom: windowHeight(6.8) },
          ]}
        >
          {translateData.availableArea || 'Available Area'}
        </Text>
        <View style={[styles.dropdownView, { flexDirection: viewRtlStyle }]}>
          <View style={[styles.inputView, { borderColor: colors.border }]}>
            <TextInput
              style={[
                styles.input,
                { color: isDark ? appColors.white : appColors.primaryFont },
              ]}
              placeholderTextColor={appColors.secondaryFont}
              placeholder="Enter area name"
              value={availableArea}
              onChangeText={setAvailableArea}
            />
          </View>
          <Dropdown
            open={openKM}
            value={selectedKMValue}
            items={totalKM}
            onChange={setSelectedKMValue}
            setOpen={setOpenKM}
            containerStyle={styles.dropDownStyle}
            zIndex={1}
          />
        </View>
        <View style={styles.dashLine} />
        <View style={[styles.statusView, { flexDirection: viewRtlStyle }]}>
          <Text style={[styles.titleStatus, { color: colors.text }]}>
            {translateData.offerActiveStatus || 'Offer Active Status'}
          </Text>
          <Switch
            switchOn={isThemeOn}
            onPress={handleThemeToggle}
            background={colors.background}
          />
        </View>
        <Text style={[styles.discription, { textAlign: textRtlStyle }]}>
          {translateData.note || 'Note: Active offers will be visible to riders searching for carpooling options.'}
        </Text>
      </View>
      <View></View>
      <Button
        title={translateData.createOffer || 'Create Offer'}
        backgroundColor={appColors.primary}
        color={appColors.white}
        onPress={handleSubmit}
        loading={loading}
      />
    </ScrollView>
  )
}
