declare module 'react-native-progress-bar-animated' {
  import { Component, ComponentType } from 'react';

  interface ProgressBarAnimatedProps {
    width?: number;
    height?: number;
    value?: number;
    maxValue?: number;
    backgroundColor?: string;
    backgroundColorOnComplete?: string;
    borderColor?: string;
    borderRadius?: number;
    useNativeDriver?: boolean;
  }

  const ProgressBarAnimated: ComponentType<ProgressBarAnimatedProps>;
  export default ProgressBarAnimated;
}