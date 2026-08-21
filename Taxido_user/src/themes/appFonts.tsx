export type Fonts = {
  semiBold: string;
  medium: string;
  regular: string;
  bold: string;
  extraBold: string;
  ProBold: string;
  // New font families per charter
  titleRegular: string;
  titleMedium: string;
  titleSemiBold: string;
  titleBold: string;
  bodyRegular: string;
  bodyMedium: string;
  bodyBold: string;
};

export const appFonts: Fonts = {
  // Keep backward-compatible aliases (GT Walsheim → Inter)
  semiBold: 'Inter-SemiBold',
  medium: 'Inter-Medium',
  regular: 'Inter-Regular',
  bold: 'Inter-Bold',
  extraBold: 'Inter-Bold',
  ProBold: 'Inter-Bold',
  // New explicit font families per charter
  titleRegular: 'Inter-Regular',
  titleMedium: 'Inter-Medium',
  titleSemiBold: 'Inter-SemiBold',
  titleBold: 'Inter-Bold',
  bodyRegular: 'DMSans-Regular',
  bodyMedium: 'DMSans-Medium',
  bodyBold: 'DMSans-Bold',
};

export default appFonts;
