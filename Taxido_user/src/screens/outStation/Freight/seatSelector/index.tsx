import { View, Text, TouchableOpacity, StyleSheet } from "react-native";
import React from "react";
import { useValues } from "@src/utils/context/index";
import { appColors, windowHeight, windowWidth, appFonts } from "@src/themes";

interface SeatSelectorProps {
  totalSeats: number;
  value: number;
  onChange: (value: number) => void;
  translateData: { [key: string]: string };
  textColorStyle: any;
  isDark: boolean;
}

export function SeatSelector({
  totalSeats,
  value,
  onChange,
  translateData,
  textColorStyle,
  isDark,
}: SeatSelectorProps) {
  const { viewRTLStyle, bgContainer } = useValues();
  const maxSeat = totalSeats > 0 ? totalSeats : 1;
  const isMinusDisabled = value <= 1;
  const isPlusDisabled = value >= maxSeat;

  return (
    <View>
      <Text style={[styles.titleText, { color: textColorStyle }]}>
        {translateData.seatSelector}
      </Text>
      <View style={[styles.row, { flexDirection: viewRTLStyle }]}>
        <TouchableOpacity
          activeOpacity={0.7}
          style={[
            styles.seatBtn,
            isMinusDisabled && { opacity: 0.4 },
            { backgroundColor: isDark ? appColors.darkBorder : appColors.lightGray },
          ]}
          onPress={() => onChange(Math.max(1, value - 1))}
          disabled={isMinusDisabled}
        >
          <Text style={[styles.seatBtnText, { color: textColorStyle }]}>-</Text>
        </TouchableOpacity>
        <View style={[styles.seatValueView, { backgroundColor: bgContainer }]}>
          <Text style={[styles.seatValue, { color: textColorStyle }]}>{value}</Text>
          <Text style={[styles.seatRemaining, { color: appColors.regularText }]}>
            {translateData.seatRemaining
              ?.replace("{total}", String(maxSeat))
              ?.replace("{value}", String(maxSeat - value))}
          </Text>
        </View>
        <TouchableOpacity
          activeOpacity={0.7}
          style={[
            styles.seatBtn,
            isPlusDisabled && { opacity: 0.4 },
            { backgroundColor: isDark ? appColors.darkBorder : appColors.lightGray },
          ]}
          onPress={() => onChange(Math.min(maxSeat, value + 1))}
          disabled={isPlusDisabled}
        >
          <Text style={[styles.seatBtnText, { color: textColorStyle }]}>+</Text>
        </TouchableOpacity>
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
  row: {
    alignItems: "center",
    justifyContent: "space-between",
    borderWidth: windowHeight(1),
    borderColor: appColors.border,
    borderRadius: windowHeight(8),
    padding: windowHeight(6),
  },
  seatBtn: {
    width: windowWidth(52),
    height: windowHeight(36),
    borderRadius: windowHeight(6),
    alignItems: "center",
    justifyContent: "center",
  },
  seatBtnText: {
    fontFamily: appFonts.medium,
    fontSize: 20,
  },
  seatValueView: {
    alignItems: "center",
    flex: 1,
    marginHorizontal: windowWidth(8),
    paddingVertical: windowHeight(4),
  },
  seatValue: {
    fontFamily: appFonts.bold,
    fontSize: 18,
  },
  seatRemaining: {
    fontFamily: appFonts.regular,
    fontSize: 12,
    marginTop: windowHeight(2),
  },
});
