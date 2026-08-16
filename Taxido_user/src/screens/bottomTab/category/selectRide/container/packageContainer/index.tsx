import React, { useState, useEffect } from 'react';
import { View, FlatList } from 'react-native';
import { external } from '../../../../../../styles/externalStyle';
import { PackageItem } from './packageItem/index';
import { useDispatch, useSelector } from 'react-redux';
import { packageDataGet } from '@src/api/store/actions/packageAction';
import { AppDispatch } from '@src/api/store';

export function KmDetails({ onPackageSelect, onpackageVehicle, zoneValue }: { onPackageSelect: any; onpackageVehicle: any; zoneValue: any }) {
  const [selectedId, setSelectedId] = useState<any>(null);
  const { packageList } = useSelector((state: any) => state.package);
  const dispatch = useDispatch<AppDispatch>();


  useEffect(() => {
    dispatch(packageDataGet({ zone_id: zoneValue?.id }));
  }, []);

  useEffect(() => {
    if (packageList?.data?.length > 0 && selectedId === null) {
      const firstItem = packageList.data[0];
      setSelectedId(firstItem.id);

      const details = {
        hour: firstItem?.hour,
        distance: firstItem?.distance,
        id: firstItem?.id,
        distanceType: firstItem?.distance_type,
        currency_symbol: firstItem?.currency_symbol
      };
      onPackageSelect(details);
      onpackageVehicle(firstItem.vehicle_types);
    }
  }, [packageList.data]);

  const handlePress = (item: any) => {
    setSelectedId(item.id);
    const details = { hour: item.hour, distance: item.distance, id: item.id, distanceType: item.distance_type, currency_symbol: item?.currency_symbol };
    onPackageSelect(details);
    const vehicleDetails = item.vehicle_types;
    onpackageVehicle(vehicleDetails);
  };

  const renderItem = ({ item }: { item: any }) => (
    <PackageItem
      item={item}
      isSelected={item.id === selectedId}
      onPress={() => handlePress(item)}
    />
  );

  return (
    <View style={external.mv_15}>
      <FlatList
        horizontal={true}
        renderItem={renderItem}
        data={packageList.data}
        showsHorizontalScrollIndicator={false}
        contentContainerStyle={external.mh_5}
        keyExtractor={(item) => item.id.toString()}
        removeClippedSubviews={true}
      />
    </View>
  );
};
