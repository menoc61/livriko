import { View, ScrollView } from "react-native";
import React, { useState } from "react";
import { useAppRoute } from '@src/utils/navigation';
import { Header } from "@src/commonComponent";
import { appColors } from "@src/themes";
import { useSelector } from "react-redux";
import styles from "./styles";
import { useValues } from "@src/utils/context/index";
import { HomeSlider, TodayOfferContainer, TopCategory } from "@src/components";
import { Recentbooking } from "../recentBooking";
import { BottomTitle } from "@src/components";
import { HomeServiceLoader } from "./component";

export function HomeService() {
  const route = useAppRoute();
  const { itemName } = route.params || {};
  const { homeScreenData, homeScreenDataPrimary, loading } = useSelector((state: any) => state.home);
  const { isDark, linearColorStyle } = useValues();
  const [isScrolling, setIsScrolling] = useState(true);

  const serviceCategories =
    homeScreenData?.service_categories?.length > 0
      ? homeScreenData.service_categories
      : homeScreenDataPrimary?.service_categories;

  const hasPrimaryData =
    homeScreenDataPrimary &&
    typeof homeScreenDataPrimary === 'object' &&
    !Array.isArray(homeScreenDataPrimary) &&
    Object.keys(homeScreenDataPrimary).length > 0;

  const isDataEmpty =
    (!homeScreenData ||
     (Array.isArray(homeScreenData) && homeScreenData.length === 0) ||
     (typeof homeScreenData === 'object' && !Array.isArray(homeScreenData) && Object.keys(homeScreenData).length === 0) ||
     homeScreenData === null) &&
    !hasPrimaryData;

  return (
    <View
      style={[
        styles.mainView,
        { backgroundColor: isDark ? linearColorStyle : appColors.lightGray },
      ]}
    >
      <Header value={itemName} />
      {loading || isDataEmpty ? (
        <HomeServiceLoader />
      ) : (
        <ScrollView
          showsVerticalScrollIndicator={false}
          removeClippedSubviews={true}
          nestedScrollEnabled={true}
          scrollEnabled={isScrolling}
          contentContainerStyle={[
            styles.containerStyle,
            {
              backgroundColor: isDark ? appColors.bgDark : appColors.lightGray,
            },
          ]}
        >
          <HomeSlider
            onSwipeStart={() => setIsScrolling(false)}
            onSwipeEnd={() => setIsScrolling(true)}
            bannerData={homeScreenData?.banners || homeScreenDataPrimary?.banners}
          />
          <TopCategory categoryData={serviceCategories} />
          <Recentbooking recentRideData={homeScreenData?.recent_rides || homeScreenDataPrimary?.recent_rides} />
          <TodayOfferContainer couponsData={homeScreenData?.coupons || homeScreenDataPrimary?.coupons} />
          <BottomTitle />
        </ScrollView>
      )}
    </View>
  );
}
