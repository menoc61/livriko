import { StyleSheet } from 'react-native'
import appColors from '../../../../theme/appColors'
import appFonts from '../../../../theme/appFonts'
import {
  fontSizes,
  windowHeight,
  windowWidth,
} from '../../../../theme/appConstant'

const styles = StyleSheet.create({
  main: {
    width: '100%',
    borderWidth: windowHeight(0.1),
    borderRadius: windowHeight(0.5),
    paddingVertical: windowHeight(1.5),
    paddingHorizontal: windowWidth(3),
    marginTop: windowHeight(1.5),
  },
  headerRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginBottom: windowHeight(1),
  },
  badge: {
    flexDirection: 'row',
    alignItems: 'center',
    backgroundColor: appColors.cardicon,
    borderRadius: windowHeight(3),
    paddingHorizontal: windowWidth(2.5),
    paddingVertical: windowHeight(0.4),
  },
  badgeText: {
    color: appColors.scheduleColor,
    fontFamily: appFonts.medium,
    fontSize: fontSizes.FONT3SMALL,
  },
  price: {
    color: appColors.price,
    fontFamily: appFonts.bold,
    fontSize: fontSizes.FONT4HALF,
  },
  locationsRow: {
    flexDirection: 'row',
    alignItems: 'flex-start',
    marginBottom: windowHeight(1),
  },
  stops: {
    marginRight: windowWidth(2),
    alignItems: 'center',
  },
  stopDot: {
    height: windowHeight(1),
    width: windowHeight(1),
    borderRadius: windowHeight(0.5),
    backgroundColor: appColors.primary,
  },
  stopLine: {
    width: windowHeight(0.1),
    height: windowHeight(2.5),
    borderLeftWidth: windowHeight(0.1),
    borderStyle: 'dashed',
    borderColor: appColors.bordercolor,
  },
  stopEndDot: {
    height: windowHeight(1),
    width: windowHeight(1),
    borderRadius: windowHeight(0.5),
    backgroundColor: appColors.darkBorderBlack,
  },
  locationTextContainer: {
    flex: 1,
  },
  pickup: {
    fontSize: fontSizes.FONT3HALF,
    fontFamily: appFonts.regular,
    color: appColors.primaryFont,
  },
  drop: {
    fontSize: fontSizes.FONT3HALF,
    fontFamily: appFonts.regular,
    color: appColors.primaryFont,
    marginTop: windowHeight(1),
  },
  metaRow: {
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
    marginTop: windowHeight(1),
  },
  metaItem: {
    flexDirection: 'row',
    alignItems: 'center',
  },
  metaLabel: {
    color: appColors.secondaryFont,
    fontFamily: appFonts.regular,
    fontSize: fontSizes.FONT3SMALL,
    marginLeft: windowWidth(1),
  },
  metaValue: {
    color: appColors.primaryFont,
    fontFamily: appFonts.medium,
    fontSize: fontSizes.FONT3SMALL,
  },
  acceptBtn: {
    backgroundColor: appColors.primary,
    alignItems: 'center',
    justifyContent: 'center',
    height: windowHeight(5.5),
    borderRadius: windowWidth(1.8),
    marginTop: windowHeight(1.5),
  },
  acceptText: {
    color: appColors.white,
    fontFamily: appFonts.medium,
    fontSize: fontSizes.FONT3HALF,
  },
  announcementTitle: {
    color: appColors.primary,
    fontFamily: appFonts.medium,
    fontSize: fontSizes.FONT4,
  },
})

export default styles