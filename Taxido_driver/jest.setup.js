import mockRNCNetInfo from '@react-native-community/netinfo/jest/netinfo-mock.js';
import mockAsyncStorage from '@react-native-async-storage/async-storage/jest/async-storage-mock.js';
import 'react-native-gesture-handler/jestSetup';

jest.mock('@react-native-community/netinfo', () => mockRNCNetInfo);
jest.mock('@react-native-async-storage/async-storage', () => mockAsyncStorage);

jest.mock('react-native-worklets', () => ({
  useAnimatedGestureHandler: jest.fn(),
  useSharedValue: jest.fn(),
  useDerivedValue: jest.fn(),
  runOnUI: jest.fn(),
  runOnJS: jest.fn(),
  useAnimatedStyle: jest.fn(),
  withTiming: jest.fn(),
  withDelay: jest.fn(),
  withSpring: jest.fn(),
  useWorkletCallback: jest.fn(),
  useAnimatedReaction: jest.fn(),
  interpolate: jest.fn(),
  useAnimatedScrollHandler: jest.fn(),
  setInterval: jest.fn(),
  clearInterval: jest.fn(),
  NativeModules: {},
}));

jest.mock('react-native-reanimated', () => ({
  default: {
    useSharedValue: jest.fn(),
    useDerivedValue: jest.fn(),
    useAnimatedStyle: jest.fn(),
    withTiming: jest.fn(),
    withDelay: jest.fn(),
    withSpring: jest.fn(),
    useWorkletCallback: jest.fn(),
    useAnimatedReaction: jest.fn(),
    interpolate: jest.fn(),
    useAnimatedScrollHandler: jest.fn(),
    Easing: {},
    Extrapolate: { CLAMP: 'clamp' },
    Animated: {},
    View: 'View',
    Text: 'Text',
    ScrollView: 'ScrollView',
  },
}));

jest.mock('react-native-get-location', () => ({
  getCurrentPosition: jest.fn().mockResolvedValue({ latitude: 0, longitude: 0 }),
}));
jest.mock('@react-native-clipboard/clipboard', () => ({
  default: {
    setString: jest.fn(),
    getString: jest.fn().mockResolvedValue(''),
  },
}));
jest.mock('@notifee/react-native', () => ({
  requestPermission: jest.fn().mockResolvedValue({ granted: true }),
  createChannel: jest.fn(),
  displayNotification: jest.fn(),
  onForegroundEvent: jest.fn(),
  onBackgroundEvent: jest.fn(),
  AndroidImportance: {},
  EventType: {},
}));

jest.mock('@gorhom/bottom-sheet', () => ({
  default: 'BottomSheet',
  BottomSheet: 'BottomSheet',
  BottomSheetModal: 'BottomSheetModal',
  BottomSheetView: 'BottomSheetView',
  BottomSheetModalProvider: ({ children }) => children,
  BottomSheetBackdrop: 'BottomSheetBackdrop',
  BottomSheetHandle: 'BottomSheetHandle',
}));

jest.mock('react-native-sound', () => {
  class MockSound {
    constructor() {
      this.play = jest.fn();
      this.pause = jest.fn();
      this.stop = jest.fn();
      this.release = jest.fn();
      this.setVolume = jest.fn();
      this.getVolume = jest.fn();
      this.setNumberOfLoops = jest.fn();
      this.setCurrentTime = jest.fn();
    }
    static isAndroid() { return false; }
    static MAIN_BUNDLE = 'mainBundle';
  }
  return MockSound;
});

jest.mock('react-native-dropdown-picker', () => 'DropdownPicker');
jest.mock('@react-native-documents/picker', () => ({
  types: { images: [], allFiles: [] },
  pick: jest.fn(),
  pickMultiple: jest.fn(),
  pickSingle: jest.fn(),
}));
jest.mock('react-native-blob-util', () => {
  class ReactNativeBlobUtil {
    static config = jest.fn().mockReturnValue({ fetch: jest.fn().mockResolvedValue({ info: jest.fn(), json: jest.fn(), path: jest.fn() }) });
    static fetch = jest.fn();
    static base64 = { encode: jest.fn(), decode: jest.fn() };
    static fs = {
      dirs: { DocumentDir: '', CacheDir: '', MainBundleDir: '', DocumentDirectory: '', CacheDirectory: '' },
      exists: jest.fn(),
      unlink: jest.fn(),
      writeFile: jest.fn(),
      readFile: jest.fn(),
      mkdir: jest.fn(),
      ls: jest.fn(),
      stat: jest.fn(),
    };
  }
  return ReactNativeBlobUtil;
});
jest.mock('react-native-permissions', () => ({
  check: jest.fn().mockResolvedValue('granted'),
  request: jest.fn().mockResolvedValue('granted'),
  requestMultiple: jest.fn().mockResolvedValue({}),
  checkMultiple: jest.fn().mockResolvedValue({}),
  openSettings: jest.fn(),
  PERMISSIONS: { ANDROID: {}, IOS: {} },
  RESULTS: { GRANTED: 'granted', DENIED: 'denied', BLOCKED: 'blocked' },
}));
jest.mock('react-native-image-picker', () => ({
  launchImageLibrary: jest.fn(),
  launchCamera: jest.fn(),
  ImagePickerConstants: {},
}));
jest.mock('react-native-fs', () => ({
  DocumentDirectoryPath: '',
  CacheDirectoryPath: '',
  writeFile: jest.fn().mockResolvedValue(undefined),
  readFile: jest.fn().mockResolvedValue(''),
  unlink: jest.fn().mockResolvedValue(undefined),
  mkdir: jest.fn().mockResolvedValue(undefined),
  exists: jest.fn().mockResolvedValue(false),
  downloadFile: jest.fn(),
}));
jest.mock('react-native-otp-textinput', () => 'OtpTextInput');
jest.mock('react-native-country-select', () => 'CountrySelect');
jest.mock('react-native-popup-menu', () => ({
  MenuProvider: ({ children }) => children,
  Menu: ({ children }) => children,
  MenuTrigger: ({ children }) => children,
  MenuOptions: ({ children }) => children,
  MenuOption: () => null,
}));
jest.mock('react-native-android-location-enabler', () => ({
  promptForEnableLocationIfNeeded: jest.fn().mockResolvedValue(true),
}));
jest.mock('@react-native-camera-roll/camera-roll', () => ({
  CameraRoll: { save: jest.fn(), getPhotos: jest.fn() },
}));
jest.mock('react-native-notifier', () => ({
  Notifier: { showNotification: jest.fn() },
  showNotification: jest.fn(),
  NotifierRoot: ({ children }) => children,
  NotifierWrapper: ({ children }) => children,
}));
jest.mock('react-native-share', () => ({
  default: { open: jest.fn().mockResolvedValue({}) },
  open: jest.fn().mockResolvedValue({}),
  isPackageInstalled: jest.fn().mockResolvedValue(true),
}));
jest.mock('react-native-google-mobile-ads', () => ({
  MobileAds: { configure: jest.fn().mockResolvedValue(undefined) },
  BannerAd: () => null,
  BannerAdSize: {},
  AdEventType: {},
  RewardedAd: { createForAdRequest: jest.fn() },
  NativeAd: () => null,
  NativeAdView: ({ children }) => children,
  NativeAsset: ({ children }) => children,
  NativeAdMedia: () => null,
  TestIds: {},
}));
jest.mock('react-native-reanimated-carousel', () => 'CarouselMock');
jest.mock('@react-native-community/geolocation', () => ({
  getCurrentPosition: jest.fn(),
  watchPosition: jest.fn(),
  clearWatch: jest.fn(),
  stopObserving: jest.fn(),
}));
jest.mock('react-native-geolocation-service', () => ({
  getCurrentPosition: jest.fn(),
  watchPosition: jest.fn(),
  clearWatch: jest.fn(),
}));
jest.mock('react-native-get-location', () => ({
  getCurrentPosition: jest.fn().mockResolvedValue({ latitude: 0, longitude: 0 }),
}));
jest.mock('react-native-device-info', () => ({
  getUniqueId: jest.fn().mockResolvedValue('test-device-id'),
  getVersion: jest.fn().mockResolvedValue('1.0.0'),
  getBuildNumber: jest.fn().mockResolvedValue('1'),
  getSystemName: jest.fn().mockResolvedValue('iOS'),
  getSystemVersion: jest.fn().mockResolvedValue('15.0'),
  getDeviceName: jest.fn().mockResolvedValue('Test Device'),
  getBrand: jest.fn().mockResolvedValue('Apple'),
  getModel: jest.fn().mockResolvedValue('iPhone'),
  isEmulator: jest.fn().mockResolvedValue(false),
  isTablet: jest.fn().mockResolvedValue(false),
  hasNotch: jest.fn().mockResolvedValue(false),
}));
jest.mock('@react-native-firebase/app', () => ({
  initializeApp: jest.fn(),
  app: () => ({ name: '[DEFAULT]' }),
  apps: [],
  SDK_VERSION: '0.0.0',
}));
jest.mock('@react-native-firebase/auth', () => ({
  default: () => ({
    currentUser: null,
    onAuthStateChanged: jest.fn(),
    signInWithEmailAndPassword: jest.fn(),
    createUserWithEmailAndPassword: jest.fn(),
    signOut: jest.fn(),
  }),
}));
jest.mock('@react-native-firebase/storage', () => ({
  default: () => ({
    ref: jest.fn().mockReturnValue({
      putFile: jest.fn().mockResolvedValue({}),
      putString: jest.fn().mockResolvedValue({}),
      getDownloadURL: jest.fn().mockResolvedValue(''),
      delete: jest.fn().mockResolvedValue({}),
    }),
  }),
}));
jest.mock('@react-native-firebase/messaging', () => {
  const mockMessaging = () => ({
    getToken: jest.fn().mockResolvedValue('test-token'),
    onMessage: jest.fn(),
    requestPermission: jest.fn(),
    setBackgroundMessageHandler: jest.fn(),
    onNotificationOpenedApp: jest.fn(),
    getInitialNotification: jest.fn().mockResolvedValue(null),
    hasPermission: jest.fn().mockResolvedValue(true),
    deleteToken: jest.fn(),
    subscribeToTopic: jest.fn(),
    unsubscribeFromTopic: jest.fn(),
  });
  mockMessaging.AuthorizationStatus = {
    NOT_DETERMINED: 0,
    DENIED: 1,
    AUTHORIZED: 2,
    PROVISIONAL: 3,
  };
  return mockMessaging;
});
jest.mock('react-native-screens', () => {
  const screens = jest.requireActual('react-native-screens');
  if (screens.enableScreens) {
    try { screens.enableScreens(); } catch (e) {}
  }
  return screens;
});
jest.mock('react-native-webview', () => 'WebView');
jest.mock('react-native-svg', () => {
  const React = require('react');
  const View = require('react-native').View;
  const createComponent = (name) => (props) => React.createElement(View, props);
  return {
    Svg: createComponent('Svg'),
    Path: createComponent('Path'),
    Circle: createComponent('Circle'),
    Rect: createComponent('Rect'),
    Line: createComponent('Line'),
    Polyline: createComponent('Polyline'),
    Polygon: createComponent('Polygon'),
    Text: createComponent('Text'),
    G: createComponent('G'),
    Defs: createComponent('Defs'),
    LinearGradient: createComponent('LinearGradient'),
    Stop: createComponent('Stop'),
    ClipPath: createComponent('ClipPath'),
    default: createComponent('Svg'),
  };
});
jest.mock('react-native-swiper', () => 'Swiper');
jest.mock('react-native-switch-toggle', () => 'SwitchToggle');
jest.mock('react-native-chat-head', () => ({
  default: 'ChatHead',
  ChatHead: 'ChatHead',
}));
jest.mock('react-native-gifted-charts', () => ({
  LineChart: 'LineChart',
  BarChart: 'BarChart',
  PieChart: 'PieChart',
  DonutChart: 'DonutChart',
  PopulationPyramid: 'PopulationPyramid',
  HorizontalBarChart: 'HorizontalBarChart',
}));
jest.mock('react-native-paper', () => ({
  default: {},
  Provider: ({ children }) => children,
  Button: 'PaperButton',
  Text: 'PaperText',
  ActivityIndicator: 'PaperActivityIndicator',
}));
jest.mock('rn-tourguide', () => ({
  TourGuideProvider: ({ children }) => children,
  useTourGuideController: jest.fn().mockReturnValue({ start: jest.fn(), stop: jest.fn() }),
}));
jest.mock('lottie-react-native', () => 'LottieView');
jest.mock('@react-native-community/datetimepicker', () => 'DateTimePicker');
jest.mock('@react-native-masked-view/masked-view', () => 'MaskedView');
jest.mock('react-content-loader', () => ({
  Facebook: 'FacebookLoader',
  Instagram: 'InstagramLoader',
  default: 'ContentLoader',
}));
jest.mock('react-native-webview', () => 'WebView');
