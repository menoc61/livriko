

export type AddLocationDetailsProps = {
  userName: string;
  countryCode: string;
  phoneNumber: number;
  email: string;
  referralID: string;
};

export type ticketDataProps = {
  value: number | any;
};

export type OtpVerificationParams = {

  countryCode?: string;
  phoneNumber?: string;
  demouser?: boolean;
  cca2?: string;

};

export type SignUpParams = {
  countryCode?: string,
  phoneNumber?: string,
  cca2?: string,
}

export type ChooseRiderScreen = {
  destination: string;
  stops?: any[];
  pickupLocation: string;
  service_ID: string | number;
  zoneValue: string | number;
  scheduleDate: string;
  service_category_ID: string | number;
  selectedImage?: string;
  parcelWeight?: string | number;
  pickupCoords: { lat: number; lng: number };
  destinationCoords: { lat: number; lng: number };
};

export type RideActive = {
  activeRideOTP: any;
  filteredLocations?: any[];
}

export type PromoCodeScreen = {
  from: "payment" | "wallet" | string;
  getCoupon: (coupon: any) => void;
};


export type RootStackParamList = {
  Splash: undefined;
  SignIn: undefined;
  OtpVerification: OtpVerificationParams;
  SignUp: SignUpParams;
  AddNewLocation: undefined;
  Notifications: undefined;
  EmptyNotification: undefined;
  HomeScreen: undefined;
  DateTimeSchedule: undefined;
  ProfileSetting: undefined;
  EditProfile: undefined;
  PromoCodeScreen: PromoCodeScreen;
  BankDetail: undefined;
  SavedLocation: Record<string, any> | undefined;
  MyTabs: any;
  AppPageScreen: undefined;
  CompleteRideScreen: undefined;
  CancelRideScreen: undefined;
  PendingRideScreen: Record<string, any> | undefined;
  SelectRide: undefined;
  DriverDetails: undefined;
  FindingDriver: undefined;
  Onboarding: undefined;
  OutStation: undefined;
  LocationDrop: undefined;
  ChooseRider: undefined;
  BookRide: Record<string, any> | undefined;
  CancelRide: undefined;
  CancelFare: undefined;
  AddNewRider: Record<string, any> | undefined;
  OnTheWayDetails: undefined;
  DriverInfos: undefined;
  ChatScreen: Record<string, any> | undefined;
  RideActive: RideActive;
  Payment: Record<string, any> | undefined;
  Calander: Record<string, any> | undefined;
  Share: undefined;
  OtpVerify: undefined;
  ResetPassword: undefined;
  SignInWithMail: undefined;
  AddLocationDetails: undefined | AddLocationDetailsProps;
  CompleteRide: undefined;
  LocationSelect: Record<string, any> | undefined;
  ActiveRideScreen: undefined;
  ScheduleRideScreen: undefined;
  Rental: Record<string, any> | undefined;
  Outstation: Record<string, any> | undefined;
  Ride: Record<string, any> | undefined;
  ChooseRiderScreen: ChooseRiderScreen;
  PaymentRental: undefined;
  Wallet: undefined;
  PaymentMethod: undefined;
  PromoCodeDetail: undefined;
  AddLocation: undefined;
  TopUpWallet: undefined;
  HomeService: Record<string, any> | undefined;
  PaymentWebView: Record<string, any> | undefined;
  RentalLocation: Record<string, any> | undefined;
  PackageInfo: Record<string, any> | undefined;
  RentalLocationSearch: undefined;
  LocationSave: Record<string, any> | undefined;
  RentalBooking: Record<string, any> | undefined;
  RentalVehicleSelect: Record<string, any> | undefined;
  CreateTicket: undefined;
  SupportTicket: undefined;
  TicketDetails: undefined | ticketDataProps;
  RentalCarDetails: Record<string, any> | undefined;
  Profile: undefined;
  NoService: undefined;
  NoInternet: any;
  AmbulanceSearch: Record<string, any> | undefined;
  BookAmbulance: Record<string, any> | undefined;
  AmbulancePayment: Record<string, any> | undefined;
  CarpoolingHome: undefined;
  PublishRide: undefined;
  AddVehicle: Record<string, any> | undefined;
  FindDriverHome: undefined;
  OneWaySelect: Record<string, any> | undefined;
  OneWayRideDetails: Record<string, any> | undefined;
  OneWayDaily: Record<string, any> | undefined;
  AmbulanceHome: undefined;
  PdfViewer: Record<string, any> | undefined;
  NoInternalServer: undefined
  ReferralList: undefined
  ReferralID: undefined;
  RideMapView: { rideData: any };
  Stopover: Record<string, any> | undefined;
  EditStopOver: Record<string, any> | undefined;
  carpoolingDate: Record<string, any> | undefined;
  EditVehicle: Record<string, any> | undefined;
  SeatSet: Record<string, any> | undefined;
  PriceSet: Record<string, any> | undefined;
  CarpoolingDetails: Record<string, any> | undefined;
  AddressChange: Record<string, any> | undefined;
  EditDetails: Record<string, any> | undefined;
  FindLocationScreen: Record<string, any> | undefined;
  DriverRequestScreen: undefined;
  DriverRequestDetailsScreen: { item: any };
};
