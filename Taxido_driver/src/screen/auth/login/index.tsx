import React, { useState, useCallback, useMemo, useEffect } from 'react'
import { BackHandler, View } from 'react-native'
import { useIsFocused } from '@react-navigation/native'
import { useDispatch, useSelector } from 'react-redux'
import styles from './styles'
import appColors from '../../../theme/appColors'
import { Background, Header } from '../component'
import { LoginView } from './component/'
import { useValues } from '../../../utils/context'
import { AppDispatch } from '../../../api/store'
import {
  fleetsLogin,
  taxidosettingDataGet,
  userLogin,
} from '../../../api/store/action'
import { notificationHelper } from '../../../commonComponents'
import {
  DriverLoginInterface,
  FleetLoginInterface,
} from '../../../api/interface/authInterface'
import { getValue, setValue } from '../../../utils/localstorage'
import { useAppNavigation } from '../../../utils/navigation'
import { getFcmToken } from '../../../utils/pushNotificationHandler'

import { getAllCountries } from 'react-native-country-select/lib/utils/countryHelpers'

export function Login() {
  const { translateData, taxidoSettingData } = useSelector((state: any) => state.setting)
  const [cca2, setCca2] = useState('US')
  const { isDark } = useValues()
  const dispatch = useDispatch<AppDispatch>()
  const navigation = useAppNavigation()
  const [phoneNumber, setPhoneNumber] = useState<string>('')
  const defaultCountryCode = `${taxidoSettingData?.cabbooking_values?.ride?.country_code || ''}`
  const [countryCode, setCountryCode] = useState(defaultCountryCode ? `+${defaultCountryCode}` : '')
  const [demouser, setDemouser] = useState<boolean>(false)
  const [fcmToken, setFcmToken] = useState<string>('')
  const isFocused = useIsFocused()
  const formattedCountryCode = useMemo(() => {
    return countryCode.startsWith('+') ? countryCode.substring(1) : countryCode
  }, [countryCode])
  const [driverLoading, setDriverLoading] = useState<boolean>(false)
  const [fleetLoading, setFleetLoading] = useState<boolean>(false)

  useEffect(() => {
    dispatch(taxidosettingDataGet())
    const fetchToken = async () => {
      try {
        const token = await getValue('fcmToken')
        if (token) {
          setFcmToken(token)
        } else {
          const newToken = await getFcmToken()
          if (newToken) {
            setFcmToken(newToken)
            await setValue('fcmToken', newToken)
          }
        }
      } catch (error) { }
    }
    if (isFocused) {
      fetchToken()
    }
  }, [isFocused])

  const gotoOTP = useCallback(
    async (userType: string) => {
      setDriverLoading(true)
      const payload: DriverLoginInterface = {
        email_or_phone: phoneNumber,
        country_code: formattedCountryCode,
        fcm_token: fcmToken,
      }

      try {
        const res = await dispatch(userLogin(payload)).unwrap()
        if (res?.success) {
          await setValue('userType', userType)
          navigation.navigate('Otp', {
            countryCode,
            phoneNumber,
            demouser,
            cca2,
            userType,
          })
          notificationHelper(
            '',
            translateData?.otpSend,
            'success',
          )
          setDriverLoading(false)
        } else {
          notificationHelper('', res.message, 'error')
          setDriverLoading(false)
        }
      } catch (error) {
        notificationHelper('', translateData?.loginFailed, 'error')
        setDriverLoading(false)
      }
    },
    [
      dispatch,
      phoneNumber,
      formattedCountryCode,
      navigation,
      demouser,
      translateData,
      cca2,
      countryCode,
      fcmToken,
    ],
  )

  useEffect(() => {
    const fetchCountryFromCode = async () => {
      const code = taxidoSettingData?.cabbooking_values?.ride?.country_code

      if (code) {
        try {
          const countries = await getAllCountries()
          const match = countries.find(
            c => c.idd.root === `+${code.toString()}`,
          )

          if (match) {
            setCountryCode(taxidoSettingData.cabbooking_values.ride.country_code)
          }
        } catch (err) { }
      }
    }

    fetchCountryFromCode()
  }, [taxidoSettingData?.cabbooking_values?.ride?.country_code])

  const gotoOTPFleet = useCallback(
    async (userType: string) => {
      const payload: FleetLoginInterface = {
        email_or_phone: phoneNumber,
        country_code: formattedCountryCode,
        fcm_token: fcmToken,
      }

      try {
        const res = await dispatch(fleetsLogin(payload)).unwrap()
        if (res?.success) {
          await setValue('userType', userType)
          navigation.navigate('Otp', {
            countryCode,
            phoneNumber,
            demouser,
            cca2,
            userType,
          })
          notificationHelper(
            '',
            translateData?.otpSend,
            'success',
          )
          setFleetLoading(false)
        } else {
          notificationHelper('', res.message, 'error')
          setFleetLoading(false)
        }
      } catch (error) {
        notificationHelper('', translateData?.loginFailed, 'error')
        setFleetLoading(false)
      }
    },
    [
      dispatch,
      phoneNumber,
      formattedCountryCode,
      navigation,
      demouser,
      translateData,
      cca2,
      countryCode,
      fcmToken,
    ],
  )


  useEffect(() => {
    const backAction = () => {
      BackHandler.exitApp()
      return true
    }

    const backHandler = BackHandler.addEventListener(
      'hardwareBackPress',
      backAction,
    )

    return () => backHandler.remove()
  }, [])

  return (
    <View
      style={[
        styles.main,
        {
          backgroundColor: isDark
            ? appColors.darkThemeSub
            : appColors.graybackground,
        },
      ]}
    >
      <Header
        showBackButton={false}
        backgroundColor={isDark ? appColors.bgDark : appColors.graybackground}
      />
      <Background />
      <View style={styles.loginView}>
        <LoginView
          gotoOTP={() => {
            setDriverLoading(false)
            gotoOTP('driver')
          }}
          driverLoading={driverLoading}
          setDriverLoading={setDriverLoading}
          fleetLoading={fleetLoading}
          setFleetLoading={setFleetLoading}
          gotoOTPFleet={gotoOTPFleet}
          phoneNumber={phoneNumber}
          setPhoneNumber={setPhoneNumber}
          countryCode={countryCode}
          setCountryCode={setCountryCode}
          borderColor={
            isDark ? appColors.primaryFont : appColors.graybackground
          }
          setCca2={setCca2}
          demouser={demouser}

          countryCode={formattedCountryCode}
        />
      </View>
    </View>
  )
}
