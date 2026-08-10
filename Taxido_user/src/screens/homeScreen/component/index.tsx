import React from "react";
import { useValues } from "@src/utils/context/index";
import { useAppNavigation, useAppRoute } from "@src/utils/navigation";
import { DateTimeSelector } from "../../dateTimeSchedule/dateTimeSelector/index";

export function Calander({ onPress }: any) {
  const { navigate, goBack } = useAppNavigation();
  const route = useAppRoute();
  const { fieldValue, categoryId, service_ID, service_name, service_category_slug, startDate: passedStartDate, startTime: passedStartTime, isRental } = route.params || {};

  const onConfirm = ({ DateValue, TimeValue }: { DateValue: string; TimeValue: string }) => {
    if (fieldValue === "Ride") {
      navigate("Ride", {
        DateValue,
        TimeValue,
        service_name: service_name,
        service_ID: service_ID,
        field: "schedule",
        categoryOption: "Cab",
        service_category_ID: categoryId,
        service_category_slug: service_category_slug,
      });
    } else {
      navigate("RentalBooking", {
        DateValue,
        TimeValue,
        service_name: service_name,
        service_ID: service_ID,
        field: fieldValue,
        service_category_ID: categoryId,
        service_category_slug: service_category_slug
      });
    }
  };

  return (
    <DateTimeSelector
      fieldValue={fieldValue}
      passedStartDate={passedStartDate}
      passedStartTime={passedStartTime}
      isRental={isRental}
      onConfirm={onConfirm}
      onClose={goBack}
    />
  );
}
