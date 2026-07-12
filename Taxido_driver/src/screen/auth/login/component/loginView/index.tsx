import { View, Text, TouchableOpacity } from 'react-native'
import React, { useCallback, useEffect, useState } from 'react'
import appColors from '../../../../../theme/appColors'
import styles from './styles'
import { Button } from '../../../../../commonComponents'
import { InputBox } from '../../../component'
import LoginViewProps from '../../types'
import { useFocusEffect, useTheme } from '@react-navigation/native'
import { useValues } from '../../../../../utils/context'
import { useDispatch, useSelector } from 'react-redux'
import { AppDispatch } from '../../../../../api/store'
import { windowHeight, windowWidth } from '../../../../../theme/appConstant'
import { AuthTitle } from '../authtitle'
import {
  taxidosettingDataGet,
  translateDataGet,
} from '../../../../../api/store/action'
import {
  validateEmail,
  ValidatePhoneNumber,
} from '../../../../../utils/validation'
import CountrySelect from 'react-native-country-select'

export function LoginView({
  gotoOTP,
  phoneNumber,
  setPhoneNumber,
  setCountryCode,
  borderColor,
  setCca2,
  driverLoading,
  setDriverLoading,

  fleetLoading,
  setFleetLoading,
  gotoOTPFleet,
  countryCode,
}: LoginViewProps) {
  const [error, setError] = useState('')
  const [numberShow, setNumberShow] = useState(true)
  const [pickerVisible, setPickerVisible] = useState(false)
  const [isFocused, setIsFocused] = useState(false)
  const { colors } = useTheme()
  const { textRtlStyle, viewRtlStyle, isDark, rtl } = useValues()
  const dispatch = useDispatch<AppDispatch>()
  const { translateData, taxidoSettingData } = useSelector(
    (state: any) => state.setting,
  )

  useEffect(() => {
    const code = taxidoSettingData?.cabbooking_values?.ride?.country_code
    if (code && setCountryCode) {
      setCountryCode(`+${code}`)
    }
  }, [taxidoSettingData])

  useFocusEffect(
    useCallback(() => {
      dispatch(translateDataGet())
      dispatch(taxidosettingDataGet())
    }, [dispatch]),
  )

  const handlePhoneNumberChange = (value: string) => {
    setPhoneNumber(value)
    setNumberShow(/^\d+$/.test(value))
  }

  const handleGetOTP = async (userType: string) => {
    setDriverLoading(true)
    const isNumeric = /^\d+$/.test(phoneNumber)

    if (isNumeric) {
      const msg = ValidatePhoneNumber(phoneNumber)
      if (msg) {
        setError(msg)
        setDriverLoading(false)
        return
      }
    } else if (phoneNumber.includes('@')) {
      const msg = validateEmail(phoneNumber)
      if (msg) {
        setError(msg)
        setDriverLoading(false)
        return
      }
    } else {
      setError(translateData?.validPhoneEmail)
      setDriverLoading(false)
      return
    }

    setError('')
    await gotoOTP(userType)
  }

  const handleGetOTPFleet = async (userType: string) => {
    if (setFleetLoading) setFleetLoading(true)
    const isNumeric = /^\d+$/.test(phoneNumber)

    if (isNumeric) {
      const msg = ValidatePhoneNumber(phoneNumber)
      if (msg) {
        setError(msg)
        setFleetLoading?.(false)
        return
      }
    } else if (phoneNumber.includes('@')) {
      const msg = validateEmail(phoneNumber)
      if (msg) {
        setError(msg)
        setFleetLoading?.(false)
        return
      }
    } else {
      setError(translateData?.validPhoneEmail)
      setFleetLoading?.(false)
      return
    }

    setError('')
    await gotoOTPFleet(userType)
  }

  return (
    <View
      style={[
        styles.main,
        { backgroundColor: isDark ? appColors.darkThemeSub : appColors.white },
      ]}
    >
      <View style={styles.subView}>
        <AuthTitle
          title={translateData?.authTitle}
          subTitle={translateData?.subTitle}
        />

        <View
          style={[
            styles.countryCodeContainer,
            {
              flexDirection: viewRtlStyle,
              justifyContent: numberShow ? 'flex-start' : 'center',
              width: '100%',
            },
          ]}
        >
          {numberShow && (
            <View
              style={[
                styles.codeComponent,
                {
                  marginRight: rtl ? 0 : windowWidth(2),
                  marginLeft: rtl ? windowWidth(2) : 0,
                },
              ]}
            >
              <TouchableOpacity
                style={[
                  styles.countryCode,
                  {
                    backgroundColor: isDark
                      ? appColors.primaryFont
                      : appColors.graybackground,
                    borderColor: isFocused
                      ? appColors.primary
                      : borderColor || colors.border,
                  },
                ]}
                onPress={() => {
                  setIsFocused(true)
                  setPickerVisible(true)
                }}
                activeOpacity={0.7}
              >
                <Text
                  style={[
                    styles.codeText,
                    { color: isDark ? appColors.white : appColors.black },
                  ]}
                >
                  {`+${countryCode}`}
                </Text>
              </TouchableOpacity>
            </View>
          )}

          <InputBox
            placeholder={translateData?.enterPhoneandEmailBoth}
            placeholderTextColor={
              isDark ? appColors.darkText : appColors.secondaryFont
            }
            value={phoneNumber}
            onChangeText={handlePhoneNumberChange}
            keyboardType="email-address"
            backgroundColors={
              isDark ? appColors.primaryFont : appColors.graybackground
            }
            autoCapitalize="none"
            borderColor={
              isDark ? appColors.primaryFont : appColors.graybackground
            }
            style={{
              flex: 1,
              marginLeft: numberShow && !rtl ? windowWidth(1.5) : 0,
              marginRight: numberShow && rtl ? windowWidth(1.5) : 0,
              height: numberShow ? windowHeight(6) : windowHeight(6.7),
              color: isDark ? appColors.darkText : appColors.primaryFont,
              textAlign: rtl ? 'right' : 'left',
            }}
          />
        </View>

        {error ? (
          <Text style={[styles.errorText, { textAlign: textRtlStyle }]}>
            {error}
          </Text>
        ) : null}
      </View>

      <View style={styles.button}>
        <View
          style={{
            flexDirection: 'row',
            justifyContent: 'space-between',
            paddingBottom: windowHeight(2),
          }}
        >
          <View style={{ width: '50%' }}>
            <Button
              onPress={() => handleGetOTP('driver')}
              title={translateData?.driver}
              backgroundColor={appColors.primary}
              color={appColors.white}
              loading={driverLoading}
            />
          </View>
          <View style={{ width: '50%' }}>
            <Button
              onPress={() => handleGetOTPFleet('fleet')}
              title={translateData?.fleet}
              backgroundColor={appColors.primary}
              color={appColors.white}
              loading={fleetLoading}
            />
          </View>
        </View>
      </View>

      {pickerVisible && (
        <CountrySelect
          visible={pickerVisible}
          onSelect={country => {
            const callingCode = country.idd.root + (country.idd.suffixes[0] || '')
            setCountryCode?.(callingCode.replace('+', ''))
            setCca2?.(country.cca2)
            setPickerVisible(false)
            setIsFocused(false)
          }}
          onClose={() => {
            setPickerVisible(false)
            setIsFocused(false)
          }}
          theme={isDark ? 'dark' : 'light'}
          modalType="bottomSheet"
        />
      )}
    </View>
  )
}
