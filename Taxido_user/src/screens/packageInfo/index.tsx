import React, { useState } from "react";
import {
  ScrollView,
  View,
  Text,
  TextInput,
  TouchableOpacity,
} from "react-native";
import { Header, Button, CommonModal } from "@src/commonComponent";
import { external } from "@src/styles/externalStyle";
import { useValues } from "@src/utils/context/index";
import { useSelector } from "react-redux";
import { appColors } from "@src/themes";
import { Info } from "@src/utils/icons";
import { useAppNavigation, useAppRoute } from "@src/utils/navigation";
import { CountryCodeContainer } from "@src/screens/auth/signIn/signInComponents";
import { DateTimeSchedule } from "@src/screens/dateTimeSchedule/index";
import { DescriptionText } from "../outStation/Freight/descriptionText/index";
import { PictureCargo } from "../outStation/Freight/pictureCargo/index";
import { PackageTypeSelector } from "../outStation/Freight/packageTypeSelector/index";
import styles from "./styles";

export function PackageInfo() {
  const { navigate } = useAppNavigation();
  const route = useAppRoute();
  const {
    service_ID,
    service_name,
    service_category_ID,
    service_category_slug,
  } = route.params || {};
  const { translateData, taxidoSettingData } = useSelector(
    (state: any) => state.setting,
  );
  const { bgContainer, textColorStyle, textRTLStyle, isDark } = useValues();

  const [receiverName, setReceiverName] = useState("");
  const [countryCode, setCountryCode] = useState("+237");
  const [phoneNumber, setPhoneNumber] = useState("");
  const [parcelWeight, setParcelWeight] = useState("");
  const [packageType, setPackageType] = useState("");
  const [descriptionText, setDescriptionText] = useState("");
  const [selectedImage, setSelectedImage] = useState(null);
  const [scheduleDate, setScheduleDate] = useState({
    DateValue: "",
    TimeValue: "",
  });
  const [showDate, setShowDate] = useState(false);
  const [errors, setErrors] = useState<{ [key: string]: string }>({});
  const [error, setError] = useState("");

  const handleDescriptionChange = (text: any) => setDescriptionText(text);
  const handleImageSelect = (imageUri: any) => setSelectedImage(imageUri);
  const handlePackageTypeSelect = (type: any) => setPackageType(type);

  const validate = () => {
    const newErrors: { [key: string]: string } = {};

    if (!receiverName?.trim())
      newErrors.receiverName = translateData.enterReceiverName;
    if (!phoneNumber?.trim())
      newErrors.phoneNumber = translateData.enterPhoneNumber;
    if (!parcelWeight?.trim()) {
      newErrors.parcelWeight = translateData.enterParcelWeight;
    } else {
      const weight = parseFloat(parcelWeight);
      const limit =
        taxidoSettingData?.cabbooking_values?.ride?.parcel_weight_limit;
      if (isNaN(weight) || (limit && weight > limit)) {
        newErrors.parcelWeight = `max ${limit || "-"}kg Allow`;
      }
    }
    if (!packageType) {
      newErrors.packageType = translateData.packageTypeRequired;
    }

    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const gotoLocations = () => {
    if (!validate()) return;

    navigate("RentalLocation", {
      service_ID,
      service_name,
      service_category_ID,
      service_category_slug,
      formattedDate: scheduleDate?.DateValue,
      formattedTime: scheduleDate?.TimeValue,
      packageInfo: {
        receiverName,
        countryCode,
        phoneNumber,
        parcelWeight,
        packageType,
        descriptionText,
        selectedImage,
      },
    });
  };

  return (
    <View style={styles.container}>
      <Header value={translateData?.packageInfo || "Package details"} />
      <ScrollView
        style={[external.fx_1]}
        contentContainerStyle={styles.content}
        showsVerticalScrollIndicator={false}
        keyboardShouldPersistTaps="handled"
      >
        <View
          style={[
            styles.noticeView,
            {
              backgroundColor: isDark
                ? appColors.darkPrimary
                : appColors.selectPrimary,
            },
          ]}
        >
          <Info />
          <Text
            style={[
              styles.noticeText,
              { color: textColorStyle },
            ]}
          >
            {translateData?.packageNotice ||
              "Describe your package first — the driver will see it before accepting."}
          </Text>
        </View>

        <Text style={[styles.label, { color: textColorStyle, textAlign: textRTLStyle }]}>
          {translateData.parcelReceiverName}
        </Text>
        <TextInput
          style={[
            styles.inputView,
            {
              backgroundColor: bgContainer,
              borderColor: isDark ? appColors.darkBorder : appColors.border,
              color: isDark ? appColors.whiteColor : appColors.blackColor,
              textAlign: textRTLStyle,
            },
          ]}
          placeholder={translateData.enterReceiverName}
          placeholderTextColor={appColors.regularText}
          value={receiverName}
          onChangeText={text => setReceiverName(text)}
        />
        {errors.receiverName && (
          <Text style={styles.errorText}>{errors.receiverName}</Text>
        )}

        <Text style={[styles.label, { color: textColorStyle, textAlign: textRTLStyle }]}>
          {translateData.parcelReceiverNumber}
        </Text>
        <CountryCodeContainer
          countryCode={countryCode}
          setCountryCode={setCountryCode}
          phoneNumber={phoneNumber}
          setPhoneNumber={setPhoneNumber}
          backGroundColor={bgContainer}
          borderColor={isDark ? appColors.darkBorder : appColors.border}
          setError={setError}
          error={error}
        />
        {errors.phoneNumber && (
          <Text style={styles.errorText}>{errors.phoneNumber}</Text>
        )}

        <Text style={[styles.label, { color: textColorStyle, textAlign: textRTLStyle }]}>
          {translateData.weightKg} (KG)
        </Text>
        <TextInput
          style={[
            styles.inputView,
            {
              backgroundColor: bgContainer,
              borderColor: isDark ? appColors.darkBorder : appColors.border,
              color: isDark ? appColors.whiteColor : appColors.blackColor,
              textAlign: textRTLStyle,
            },
          ]}
          keyboardType="number-pad"
          placeholder={translateData.enterParcelWeight}
          placeholderTextColor={appColors.regularText}
          value={parcelWeight}
          onChangeText={text => setParcelWeight(text)}
        />
        {errors.parcelWeight && (
          <Text style={styles.errorText}>{errors.parcelWeight}</Text>
        )}

        <PackageTypeSelector
          selected={packageType}
          onSelect={handlePackageTypeSelect}
          translateData={translateData}
          textColorStyle={textColorStyle}
          isDark={isDark}
        />
        {errors.packageType && (
          <Text style={styles.errorText}>{errors.packageType}</Text>
        )}

        <PictureCargo onImageSelect={handleImageSelect} service_name={service_name} />
        <DescriptionText onTextChange={handleDescriptionChange} />

        <Text style={[styles.label, { color: textColorStyle, textAlign: textRTLStyle }]}>
          {translateData.dateAndTime}
        </Text>
        <TouchableOpacity
          activeOpacity={0.7}
          onPress={() => setShowDate(true)}
          style={[
            styles.dateInputContainer,
            {
              backgroundColor: bgContainer,
              borderColor: isDark ? appColors.darkBorder : appColors.border,
            },
          ]}
        >
          <TextInput
            style={[
              styles.dateInput,
              {
                color: isDark ? appColors.whiteColor : appColors.blackColor,
              },
            ]}
            editable={false}
            placeholder={translateData.selectDateTime}
            placeholderTextColor={appColors.regularText}
            value={
              scheduleDate.DateValue && scheduleDate.TimeValue
                ? `${scheduleDate.DateValue} ${scheduleDate.TimeValue}`
                : ""
            }
          />
        </TouchableOpacity>

        <View style={styles.buttonView}>
          <Button
            title={translateData.continue || "Continue"}
            onPress={gotoLocations}
          />
        </View>
      </ScrollView>

      <CommonModal
        isVisible={showDate}
        onPress={() => setShowDate(false)}
        value={
          <View>
            <DateTimeSchedule
              onPress={() => setShowDate(false)}
              onConfirm={setScheduleDate}
            />
          </View>
        }
      />
    </View>
  );
}

export default PackageInfo;