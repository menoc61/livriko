import React, { useState, useMemo } from "react";
import { View, Text, TouchableOpacity, ScrollView } from "react-native";
import { Calendar } from "react-native-calendars";
import { useSelector } from "react-redux";
import { useValues } from "@src/utils/context/index";
import { appColors, appFonts, windowWidth } from "@src/themes";
import { Button, notificationHelper } from "@src/commonComponent";
import { Back } from "@utils/icons";
import { Wheel } from "./wheel";
import styles from "./styles";

const MONTHS_SHORT = [
  "Jan", "Feb", "Mar", "Apr", "May", "Jun",
  "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
];

const DAY_NAMES = [
  "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday",
];

const HOURS = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];
const MINUTES = Array.from({ length: 12 }, (_, i) => String(i * 5).padStart(2, "0"));
const PERIODS = ["AM", "PM"];

const pad = (n: number) => String(n).padStart(2, "0");

interface DateTimeSelectorProps {
  fieldValue?: string;
  passedStartDate?: string;
  passedStartTime?: string;
  isRental?: boolean;
  onConfirm: (payload: { DateValue: string; TimeValue: string }) => void;
  onClose: () => void;
}

export function DateTimeSelector({
  fieldValue,
  passedStartDate,
  passedStartTime,
  isRental,
  onConfirm,
  onClose,
}: DateTimeSelectorProps) {
  const { linearColorStyle, textColorStyle, bgContainer, isDark, viewRTLStyle, isRTL } = useValues();
  const { translateData } = useSelector((state: any) => state.setting);
  const [step, setStep] = useState<1 | 2 | 3 | 4>(1);
  const [mode, setMode] = useState<"now" | "schedule">("schedule");
  const [showCalendar, setShowCalendar] = useState(false);

  const [selectedDate, setSelectedDate] = useState<Date | null>(null);
  const [hour, setHour] = useState("");
  const [minute, setMinute] = useState("");
  const [period, setPeriod] = useState("AM");

  const now = new Date();
  const todayString = now.toISOString().split("T")[0];

  const label = (date: Date | null): string => {
    if (!date) return "";
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    const target = new Date(date);
    target.setHours(0, 0, 0, 0);
    if (target.getTime() === today.getTime()) return "today";
    if (target.getTime() === tomorrow.getTime()) return "tomorrow";
    return DAY_NAMES[date.getDay()];
  };

  const summaryText = useMemo(() => {
    if (!selectedDate || !hour || !minute) return "";
    const l = label(selectedDate);
    return `${l === "today" || l === "tomorrow" ? l : "on " + l} at ${hour}:${minute} ${period}`;
  }, [selectedDate, hour, minute, period]);

  const handleNow = () => {
    const roundedMinute = Math.ceil(now.getMinutes() / 5) * 5;
    const d = new Date(now);
    let h24 = d.getHours();
    let m = roundedMinute;
    if (m >= 60) {
      m = 0;
      h24 = (h24 + 1) % 24;
    }
    const p = h24 >= 12 ? "PM" : "AM";
    const h12 = h24 % 12 === 0 ? 12 : h24 % 12;
    setSelectedDate(d);
    setHour(String(h12));
    setMinute(pad(m));
    setPeriod(p);
    setMode("now");
    setStep(4);
  };

  const initWheelTime = () => {
    if (hour || minute) return;
    const roundedMinute = Math.ceil(now.getMinutes() / 5) * 5;
    let h24 = now.getHours();
    let m = roundedMinute;
    if (m >= 60) {
      m = 0;
      h24 = (h24 + 1) % 24;
    }
    const p = h24 >= 12 ? "PM" : "AM";
    const h12 = h24 % 12 === 0 ? 12 : h24 % 12;
    setHour(String(h12));
    setMinute(pad(m));
    setPeriod(p);
  };

  const toTimeStep = () => {
    initWheelTime();
    setStep(3);
  };

  const quickSelect = (offsetDays: number) => {
    const d = new Date();
    d.setDate(d.getDate() + offsetDays);
    setSelectedDate(d);
    toTimeStep();
  };

  const onDayPress = (day: any) => {
    const [y, m, dd] = day.dateString.split("-").map(Number);
    setSelectedDate(new Date(y, m - 1, dd));
    toTimeStep();
  };

  const maxDate = useMemo(() => {
    const d = new Date();
    d.setDate(d.getDate() + 15);
    return d.toISOString().split("T")[0];
  }, []);

  const validateTime = (): boolean => {
    if (!selectedDate) return false;
    const [h24] = (() => {
      let h = parseInt(hour, 10);
      if (period === "PM" && h !== 12) h += 12;
      if (period === "AM" && h === 12) h = 0;
      return [h];
    })();
    const selectedDateTime = new Date(
      selectedDate.getFullYear(),
      selectedDate.getMonth(),
      selectedDate.getDate(),
      h24,
      parseInt(minute, 10),
    );

    if (selectedDateTime <= now) {
      notificationHelper("", translateData?.dateTextInvalid || "You cannot select a past time.", "error");
      return false;
    }

    if (fieldValue === "endTime" && passedStartDate && passedStartTime) {
      const parts = passedStartDate.split(" ");
      if (parts.length >= 3) {
        const monthShortMap: Record<string, number> = { Jan: 0, Feb: 1, Mar: 2, Apr: 3, May: 4, Jun: 5, Jul: 6, Aug: 7, Sep: 8, Oct: 9, Nov: 10, Dec: 11 };
        const monthFullMap: Record<string, number> = { January: 0, February: 1, March: 2, April: 3, May: 4, June: 5, July: 6, August: 7, September: 8, October: 9, November: 10, December: 11 };
        const mm = monthShortMap[parts[1]] ?? monthFullMap[parts[1]];
        if (mm !== undefined) {
          const startDateObj = new Date(parseInt(parts[2], 10), mm, parseInt(parts[0], 10));
          const [st, sP] = passedStartTime.split(" ");
          const [sh, sm] = st.split(":").map(Number);
          let sh24 = sh;
          if (sP === "PM" && sh !== 12) sh24 += 12;
          if (sP === "AM" && sh === 12) sh24 = 0;
          const startDateTime = new Date(
            startDateObj.getFullYear(),
            startDateObj.getMonth(),
            startDateObj.getDate(),
            sh24,
            sm,
          );
          if (selectedDateTime <= startDateTime) {
            notificationHelper("", "End time must be after start time", "error");
            return false;
          }
        }
      }
    }
    return true;
  };

  const handleConfirm = () => {
    if (!selectedDate) return;
    if (!hour || !minute) {
      notificationHelper("", translateData?.datevalidationText || "Please select both date and time.", "error");
      return;
    }
    if (!validateTime()) return;
    onConfirm({
      DateValue: `${pad(selectedDate.getDate())} ${MONTHS_SHORT[selectedDate.getMonth()]} ${selectedDate.getFullYear()}`,
      TimeValue: `${hour}:${minute} ${period}`,
    });
  };

  const wheelColor = isDark ? appColors.whiteColor : appColors.primary;

  return (
    <ScrollView style={[{ backgroundColor: isDark ? appColors.bgDark : appColors.lightGray }]} showsVerticalScrollIndicator={false}>
      <TouchableOpacity
        style={[styles.backBtn, { backgroundColor: bgContainer, borderColor: isDark ? appColors.darkBorder : appColors.border }]}
        onPress={onClose}
        activeOpacity={0.7}
      >
        <Back />
      </TouchableOpacity>

      <View style={styles.header}>
        <Text style={[styles.headerTitle, { color: textColorStyle }]}>
          {translateData?.dateTimeSchedule || "Schedule your ride"}
        </Text>
      </View>

      {step === 1 && (
        <View style={styles.stepWrap}>
          <Text style={[styles.stepTitle, { color: textColorStyle }]}>
            {translateData?.whenPickup || "When do you want to be picked up?"}
          </Text>

          <TouchableOpacity
            activeOpacity={0.8}
            onPress={handleNow}
            style={[styles.bigButton, { backgroundColor: linearColorStyle }]}
          >
            <Text style={styles.bigButtonText}>{translateData?.now || "Now"}</Text>
            <Text style={styles.bigButtonSub}>{translateData?.asSoonAs || "As soon as possible"}</Text>
          </TouchableOpacity>

          <TouchableOpacity
            activeOpacity={0.8}
            onPress={() => setStep(2)}
            style={[styles.bigButton, styles.scheduleButton, { backgroundColor: bgContainer, borderColor: isDark ? appColors.darkBorder : appColors.border }]}
          >
            <Text style={[styles.bigButtonText, { color: textColorStyle }]}>{translateData?.schedule || "Schedule"}</Text>
            <Text style={[styles.bigButtonSub, { color: isDark ? appColors.gray : appColors.regularText }]}>
              {translateData?.pickLater || "Pick a date and time later"}
            </Text>
          </TouchableOpacity>
        </View>
      )}

      {step === 2 && (
        <View style={styles.stepWrap}>
          <Text style={[styles.stepTitle, { color: textColorStyle }]}>
            {translateData?.whenPickup || "When do you want to be picked up?"}
          </Text>

          <TouchableOpacity activeOpacity={0.8} onPress={() => quickSelect(0)} style={[styles.optionRow, { backgroundColor: bgContainer, borderColor: isDark ? appColors.darkBorder : appColors.border }]}>
            <Text style={[styles.optionTitle, { color: textColorStyle }]}>{translateData?.today || "Today"}</Text>
            <Text style={[styles.optionSub, { color: isDark ? appColors.gray : appColors.regularText }]}>
              {DAY_NAMES[new Date().getDay()]}
            </Text>
          </TouchableOpacity>

          <TouchableOpacity activeOpacity={0.8} onPress={() => quickSelect(1)} style={[styles.optionRow, { backgroundColor: bgContainer, borderColor: isDark ? appColors.darkBorder : appColors.border }]}>
            <Text style={[styles.optionTitle, { color: textColorStyle }]}>{translateData?.tomorrow || "Tomorrow"}</Text>
            <Text style={[styles.optionSub, { color: isDark ? appColors.gray : appColors.regularText }]}>
              {DAY_NAMES[new Date().getDay() + 1 === 7 ? 0 : new Date().getDay() + 1]}
            </Text>
          </TouchableOpacity>

          <TouchableOpacity activeOpacity={0.8} onPress={() => setShowCalendar(true)} style={[styles.optionRow, { backgroundColor: bgContainer, borderColor: isDark ? appColors.darkBorder : appColors.border }]}>
            <Text style={[styles.optionTitle, { color: textColorStyle }]}>{translateData?.chooseDate || "Choose a date"}</Text>
            <Text style={[styles.optionSub, { color: isDark ? appColors.gray : appColors.regularText }]}>
              {translateData?.viewCalendar || "View calendar"}
            </Text>
          </TouchableOpacity>

          {showCalendar && (
            <View style={[styles.calendarWrap, { backgroundColor: bgContainer }]}>
              <Calendar
                minDate={todayString}
                maxDate={maxDate}
                current={todayString}
                onDayPress={onDayPress}
                theme={{
                  backgroundColor: isDark ? appColors.darkPrimary : appColors.whiteColor,
                  calendarBackground: isDark ? appColors.darkPrimary : appColors.whiteColor,
                  selectedDayBackgroundColor: appColors.primary,
                  selectedDayTextColor: appColors.whiteColor,
                  todayTextColor: appColors.primary,
                  dayTextColor: isDark ? appColors.whiteColor : appColors.blackColor,
                  arrowColor: isDark ? appColors.whiteColor : appColors.blackColor,
                  monthTextColor: appColors.primary,
                }}
              />
            </View>
          )}
        </View>
      )}

      {step === 3 && (
        <View style={styles.stepWrap}>
          <Text style={[styles.stepTitle, { color: textColorStyle }]}>
            {selectedDate ? `${MONTHS_SHORT[selectedDate.getMonth()]} ${selectedDate.getDate()}${label(selectedDate) ? " (" + label(selectedDate) + ")" : ""}` : ""}
          </Text>
          <Text style={[styles.stepSub, { color: isDark ? appColors.gray : appColors.regularText }]}>
            {translateData?.selectTime || "Select the pickup time"}
          </Text>

          <View style={[styles.wheelRow, { flexDirection: viewRTLStyle }]}>
            <Wheel items={HOURS} value={hour} onChange={setHour} width={windowWidth(90)} color={wheelColor} isDark={isDark} />
            <Wheel items={MINUTES} value={minute} onChange={setMinute} width={windowWidth(90)} color={wheelColor} isDark={isDark} />
            <Wheel items={PERIODS} value={period} onChange={setPeriod} width={windowWidth(90)} color={wheelColor} isDark={isDark} />
          </View>

          <View style={styles.btnView}>
            <Button title={translateData?.continue || "Continue"} onPress={() => setStep(4)} />
          </View>
        </View>
      )}

      {step === 4 && (
        <View style={styles.stepWrap}>
          <View style={[styles.summaryBox, { backgroundColor: bgContainer, borderColor: isDark ? appColors.darkBorder : appColors.border }]}>
            <Text style={[styles.summaryTitle, { color: textColorStyle }]}>
              {translateData?.yourTripScheduled || "Your trip is scheduled"}
            </Text>
            <Text style={[styles.summaryText, { color: textColorStyle }]}>
              {translateData?.scheduledFor || "for"}{" "}
              <Text style={{ color: appColors.primary, fontFamily: appFonts.bold }}>{summaryText}</Text>
            </Text>
          </View>

          <View style={styles.btnView}>
            <Button
              title={translateData?.confirm || "Confirm"}
              onPress={handleConfirm}
              backgroundColor={linearColorStyle}
            />
          </View>

          {mode === "now" && (
            <TouchableOpacity activeOpacity={0.8} onPress={() => setStep(2)} style={styles.changeLink}>
              <Text style={[styles.changeLinkText, { color: appColors.primary }]}>
                {translateData?.changeTime || "Change schedule"}
              </Text>
            </TouchableOpacity>
          )}
        </View>
      )}
    </ScrollView>
  );
}
