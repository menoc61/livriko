import { View, Text, TouchableOpacity, ActivityIndicator } from 'react-native'
import React from 'react'
import styles from './styles'
import { useTheme } from '@react-navigation/native'
import { useValues } from '../../../../utils/context'
import appColors from '../../../../theme/appColors'
import Icons from '../../../../utils/icons/icons'
import { windowHeight } from '../../../../theme/appConstant'

export const Announcement = ({
  announcement,
  onAccepted,
  onAccept,
  accepting = false,
  translateData = {},
  currencySymbol = '',
}: any) => {
  const { textRtlStyle, viewRtlStyle, isDark } = useValues()
  const { colors } = useTheme()

  const pickup = announcement?.locations?.[0] || ''
  const drop = announcement?.locations?.[announcement?.locations?.length - 1] || ''

  let formattedDate = ''
  let formattedTime = ''
  if (announcement?.start_time) {
    const dateObj = new Date(announcement.start_time.replace(' ', 'T'))
    const options: any = { day: 'numeric', month: 'long', year: 'numeric' }
    formattedDate = dateObj.toLocaleDateString('en-GB', options)
    const hours = dateObj.getHours()
    let displayHours = hours % 12 || 12
    formattedTime = `${displayHours} ${hours >= 12 ? 'PM' : 'AM'}`
    if (announcement.end_time) {
      const endObj = new Date(announcement.end_time.replace(' ', 'T'))
      const endHours = endObj.getHours()
      let displayEndHours = endHours % 12 || 12
      formattedTime += ` - ${displayEndHours} ${endHours >= 12 ? 'PM' : 'AM'}`
    }
  }

  const acceptAnnouncement = () => {
    if (onAccept) {
      onAccept(announcement?.id)
    }
  }

  const seatsLabel = announcement?.total_seats
    ? `${announcement?.booked_seats || 1}/${announcement?.total_seats}`
    : null

  return (
    <View
      style={[
        styles.main,
        {
          backgroundColor: colors.card,
          borderColor: colors.border,
        },
      ]}
    >
      <View style={[styles.headerRow, { flexDirection: viewRtlStyle }]}>
        <View style={styles.badge}>
          <Icons.DayCalander color={appColors.scheduleColor} />
          <Text style={styles.badgeText}>
            {' '}
            {translateData?.scheduled || 'Scheduled'}
          </Text>
        </View>
        <Text style={styles.price}>
          {currencySymbol}
          {announcement?.total}
        </Text>
      </View>

      <View style={[styles.locationsRow, { flexDirection: viewRtlStyle }]}>
        <View style={styles.stops}>
          <View style={styles.stopDot} />
          <View style={styles.stopLine} />
          <View style={styles.stopEndDot} />
        </View>
        <View style={styles.locationTextContainer}>
          <Text
            style={[styles.pickup, { textAlign: textRtlStyle }]}
            numberOfLines={1}
          >
            {pickup}
          </Text>
          <Text style={[styles.drop, { textAlign: textRtlStyle }]} numberOfLines={1}>
            {drop}
          </Text>
        </View>
      </View>

      <View
        style={{
          borderStyle: 'dashed',
          borderBottomWidth: 1,
          borderColor: colors.border,
          marginVertical: windowHeight(0.8),
        }}
      />

      {formattedDate && (
        <View style={[styles.metaRow, { flexDirection: viewRtlStyle }]}>
          <View style={styles.metaItem}>
            <Icons.DayCalander color={colors.text} />
            <Text style={styles.metaLabel}>{formattedDate}</Text>
          </View>
          <View style={styles.metaItem}>
            <Icons.Clock color={colors.text} />
            <Text style={styles.metaLabel}>{formattedTime}</Text>
          </View>
        </View>
      )}

      {(seatsLabel || announcement?.distance) && (
        <View style={[styles.metaRow, { flexDirection: viewRtlStyle }]}>
          {seatsLabel && (
            <View style={styles.metaItem}>
              <Icons.UserName />
              <Text style={styles.metaLabel}>
                {translateData?.seats || 'Seats'}:{' '}
                <Text style={styles.metaValue}>{seatsLabel}</Text>
              </Text>
            </View>
          )}
          {announcement?.distance && (
            <View style={styles.metaItem}>
              <Icons.gps color={colors.text} />
              <Text style={styles.metaLabel}>
                {parseFloat(announcement.distance).toFixed(1)}{' '}
                {announcement?.distance_unit}
              </Text>
            </View>
          )}
        </View>
      )}

      <TouchableOpacity
        activeOpacity={0.7}
        style={styles.acceptBtn}
        onPress={acceptAnnouncement}
      >
        {accepting ? (
          <ActivityIndicator size="small" color={appColors.white} />
        ) : (
          <Text style={styles.acceptText}>
            {translateData?.Accept || 'Accept'}
          </Text>
        )}
      </TouchableOpacity>
    </View>
  )
}