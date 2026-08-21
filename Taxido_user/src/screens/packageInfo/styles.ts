import { StyleSheet } from "react-native";
import { appColors, appFonts, windowHeight } from "@src/themes";

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },
  content: {
    paddingHorizontal: windowHeight(20),
    paddingBottom: windowHeight(40),
  },
  noticeView: {
    flexDirection: "row",
    alignItems: "center",
    gap: 8,
    padding: windowHeight(14),
    borderRadius: windowHeight(8),
    marginTop: windowHeight(10),
    marginBottom: windowHeight(4),
  },
  noticeText: {
    flex: 1,
    fontFamily: appFonts.medium,
    fontSize: 13,
  },
  label: {
    fontFamily: appFonts.medium,
    marginTop: windowHeight(10),
    marginBottom: windowHeight(5),
  },
  inputView: {
    paddingHorizontal: windowHeight(12),
    borderWidth: 1,
    borderRadius: windowHeight(6),
    height: windowHeight(44),
  },
  inputText: {
    fontFamily: appFonts.regular,
    fontSize: 14,
    paddingVertical: 0,
  },
  dateInputContainer: {
    height: windowHeight(44),
    borderRadius: windowHeight(6),
  },
  dateInput: {
    height: windowHeight(44),
    paddingHorizontal: windowHeight(12),
    fontFamily: appFonts.regular,
    fontSize: 14,
  },
  errorText: {
    color: "red",
    fontSize: 12,
    marginTop: 4,
    marginLeft: 4,
  },
  buttonView: {
    marginTop: windowHeight(18),
    paddingHorizontal: windowHeight(20),
    paddingBottom: windowHeight(16),
  },
});

export default styles;