import React from 'react';
import { View } from 'react-native';
import { DateTimeSelector } from './dateTimeSelector/index';

interface Props {
  onPress?: () => void;
  onConfirm?: (payload: { DateValue: string; TimeValue: string }) => void;
}

export function DateTimeSchedule({ onPress, onConfirm }: Props) {
  return (
    <View>
      <DateTimeSelector
        onConfirm={(payload) => {
          if (onConfirm) {
            onConfirm(payload);
          }
          if (onPress) {
            onPress();
          }
        }}
        onClose={() => onPress && onPress()}
      />
    </View>
  );
}

export default DateTimeSchedule;
