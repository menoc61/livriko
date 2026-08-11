module.exports = {
  preset: 'react-native',
  setupFiles: ['./jest.setup.js'],
  moduleNameMapper: {
    '\\.(png|jpg|jpeg|gif|webp|svg)$': '<rootDir>/__mocks__/fileMock.js',
  },
  transformIgnorePatterns: [
    'node_modules/(?!(@react-native|react-native|react-native-.*|@react-navigation|@react-native-community|@gorhom|@invertase|@turf|@pusher|@react-native-firebase|react-redux|@reduxjs/toolkit|immer|@react-native-documents|react-native-dropdown-picker|react-native-svg)/)',
  ],
};
