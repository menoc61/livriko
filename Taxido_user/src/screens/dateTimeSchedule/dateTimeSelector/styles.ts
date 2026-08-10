import { StyleSheet } from "react-native";
import { appColors, appFonts, fontSizes, windowHeight, windowWidth } from "@src/themes";

const styles = StyleSheet.create({
  backBtn: {
    height: windowHeight(32),
    width: windowWidth(48),
    position: "absolute",
    borderRadius: windowHeight(6),
    alignItems: "center",
    justifyContent: "center",
    marginTop: windowHeight(16),
    marginHorizontal: windowWidth(19),
    borderColor: appColors.border,
    borderWidth: windowHeight(1),
    zIndex: 2,
  },
  header: {
    alignItems: "center",
    marginTop: windowHeight(22),
  },
  headerTitle: {
    fontFamily: appFonts.medium,
    fontSize: fontSizes.FONT28,
  },
  stepWrap: {
    marginTop: windowHeight(30),
    paddingHorizontal: windowWidth(22),
    paddingBottom: windowHeight(30),
  },
  stepTitle: {
    fontFamily: appFonts.bold,
    fontSize: fontSizes.FONT20,
    textAlign: "left",
    marginBottom: windowHeight(6),
  },
  stepSub: {
    fontFamily: appFonts.regular,
    fontSize: fontSizes.FONT14,
    marginBottom: windowHeight(12),
  },
  bigButton: {
    borderRadius: windowHeight(14),
    paddingVertical: windowHeight(22),
    paddingHorizontal: windowWidth(24),
    marginBottom: windowHeight(16),
    alignItems: "flex-start",
  },
  scheduleButton: {
    borderWidth: windowHeight(1),
  },
  bigButtonText: {
    color: appColors.whiteColor,
    fontFamily: appFonts.bold,
    fontSize: fontSizes.FONT24,
  },
  bigButtonSub: {
    color: appColors.whiteColor,
    fontFamily: appFonts.regular,
    fontSize: fontSizes.FONT14,
    marginTop: windowHeight(4),
    opacity: 0.9,
  },
  optionRow: {
    borderRadius: windowHeight(12),
    borderWidth: windowHeight(1),
    paddingVertical: windowHeight(14),
    paddingHorizontal: windowWidth(18),
    marginBottom: windowHeight(12),
    flexDirection: "row",
    alignItems: "center",
    justifyContent: "space-between",
  },
  optionTitle: {
    fontFamily: appFonts.medium,
    fontSize: fontSizes.FONT18,
  },
  optionSub: {
    fontFamily: appFonts.regular,
    fontSize: fontSizes.FONT14,
  },
  calendarWrap: {
    marginTop: windowHeight(8),
    borderRadius: windowHeight(10),
    overflow: "hidden",
  },
  wheelRow: {
    flexDirection: "row",
    justifyContent: "space-around",
    alignItems: "center",
    marginVertical: windowHeight(10),
  },
  btnView: {
    marginTop: windowHeight(12),
    marginHorizontal: windowWidth(6),
  },
  summaryBox: {
    borderWidth: windowHeight(1),
    borderRadius: windowHeight(14),
    paddingVertical: windowHeight(24),
    paddingHorizontal: windowWidth(22),
    alignItems: "center",
  },
  summaryTitle: {
    fontFamily: appFonts.bold,
    fontSize: fontSizes.FONT22,
    textAlign: "center",
    marginBottom: windowHeight(8),
  },
  summaryText: {
    fontFamily: appFonts.regular,
    fontSize: fontSizes.FONT18,
    textAlign: "center",
    lineHeight: windowHeight(26),
  },
  changeLink: {
    alignItems: "center",
    marginTop: windowHeight(18),
  },
  changeLinkText: {
    fontFamily: appFonts.medium,
    fontSize: fontSizes.FONT16,
    textDecorationLine: "underline",
  },
});

export default styles;
