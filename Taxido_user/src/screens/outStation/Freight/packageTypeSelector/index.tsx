import { View, Text, TouchableOpacity, StyleSheet } from "react-native";
import React from "react";
import { useValues } from "@src/utils/context/index";
import { appColors, windowHeight, appFonts } from "@src/themes";

const PACKAGE_TYPES = [
  { key: "documents", labelKey: "packageTypeDocuments" },
  { key: "clothing", labelKey: "packageTypeClothing" },
  { key: "food", labelKey: "packageTypeFood" },
  { key: "electronics", labelKey: "packageTypeElectronics" },
  { key: "fragile", labelKey: "packageTypeFragile" },
  { key: "other", labelKey: "packageTypeOther" },
];

interface PackageTypeSelectorProps {
  selected: string;
  onSelect: (type: string) => void;
  translateData: { [key: string]: string };
  textColorStyle: any;
  isDark: boolean;
}

export function PackageTypeSelector({ selected, onSelect, translateData, textColorStyle, isDark }: PackageTypeSelectorProps) {
  const { viewRTLStyle, bgContainer } = useValues();

  return (
    <View>
      <Text
        style={[
          styles.titleText,
          { color: textColorStyle },
        ]}>
        {translateData.packageType}
      </Text>
      <View style={[styles.container, { flexDirection: viewRTLStyle }]}>
        {PACKAGE_TYPES.map((item, index) => {
          const isSelected = selected === item.key;
          return (
            <TouchableOpacity
              key={item.key}
              activeOpacity={0.7}
              style={[
                styles.chip,
                index % 2 === 1 && styles.chipRight,
                {
                  backgroundColor: isSelected ? appColors.selectPrimary : bgContainer,
                  borderColor: isSelected ? appColors.primary : isDark ? appColors.darkBorder : appColors.border,
                },
              ]}
              onPress={() => onSelect(item.key)}>
              <Text
                style={[
                  styles.chipText,
                  { color: isSelected ? appColors.primary : textColorStyle },
                ]}>
                {translateData[item.labelKey]}
              </Text>
            </TouchableOpacity>
          );
        })}
      </View>
    </View>
  );
}

const styles = StyleSheet.create({
  titleText: {
    fontFamily: appFonts.medium,
    marginTop: windowHeight(9),
    marginBottom: windowHeight(4.8),
  },
  container: {
    flexWrap: "wrap",
  },
  chip: {
    width: "48%",
    paddingVertical: windowHeight(9),
    paddingHorizontal: windowHeight(9),
    borderWidth: windowHeight(1),
    borderRadius: windowHeight(6),
    marginBottom: windowHeight(8),
  },
  chipRight: {
    marginLeft: "4%",
  },
  chipText: {
    fontFamily: appFonts.medium,
    fontSize: 13,
  },
});
