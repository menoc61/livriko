import React, { useRef } from "react";
import { ScrollView, View, Text, TouchableOpacity, StyleSheet } from "react-native";
import { appColors, appFonts, fontSizes, windowHeight, windowWidth } from "@src/themes";

const ITEM_HEIGHT = windowHeight(52);

interface WheelProps {
  items: string[];
  value: string;
  onChange: (value: string) => void;
  width: number;
  color: string;
  isDark: boolean;
}

export function Wheel({ items, value, onChange, width, color, isDark }: WheelProps) {
  const ref = useRef<ScrollView>(null);
  const index = Math.max(0, items.indexOf(value));
  const containerHeight = ITEM_HEIGHT * 5;

  const handleScroll = (e: any) => {
    const offsetY = e.nativeEvent.contentOffset.y;
    const i = Math.round(offsetY / ITEM_HEIGHT);
    const clamped = Math.max(0, Math.min(items.length - 1, i));
    const item = items[clamped];
    if (item && item !== value) {
      onChange(item);
    }
  };

  const scrollToIndex = (i: number) => {
    const clamped = Math.max(0, Math.min(items.length - 1, i));
    ref.current?.scrollTo({ y: clamped * ITEM_HEIGHT, animated: true });
    onChange(items[clamped]);
  };

  return (
    <View style={[styles.wheelWrap, { height: containerHeight, width }]}>
      <ScrollView
        ref={ref}
        showsVerticalScrollIndicator={false}
        snapToInterval={ITEM_HEIGHT}
        decelerationRate="fast"
        onMomentumScrollEnd={handleScroll}
        contentContainerStyle={{ paddingVertical: ITEM_HEIGHT * 2 }}
        contentOffset={{ y: index * ITEM_HEIGHT, x: 0 }}
      >
        {items.map((item, i) => (
          <TouchableOpacity
            key={item}
            activeOpacity={0.7}
            style={{ height: ITEM_HEIGHT, justifyContent: "center", alignItems: "center" }}
            onPress={() => scrollToIndex(i)}
          >
            <Text
              style={[
                styles.item,
                { color: isDark ? appColors.gray : appColors.regularText },
                item === value && [styles.itemActive, { color }],
              ]}
            >
              {item}
            </Text>
          </TouchableOpacity>
        ))}
      </ScrollView>
      <View pointerEvents="none" style={[styles.indicator, { borderColor: isDark ? appColors.darkBorder : appColors.border }]} />
    </View>
  );
}

const styles = StyleSheet.create({
  wheelWrap: {
    overflow: "hidden",
  },
  item: {
    fontFamily: appFonts.regular,
    fontSize: fontSizes.FONT20,
  },
  itemActive: {
    fontFamily: appFonts.bold,
    fontSize: fontSizes.FONT24,
  },
  indicator: {
    position: "absolute",
    left: 0,
    right: 0,
    top: ITEM_HEIGHT * 2,
    height: ITEM_HEIGHT,
    borderTopWidth: windowHeight(0.6),
    borderBottomWidth: windowHeight(0.6),
  },
});
