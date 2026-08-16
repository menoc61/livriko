import { VEHICLE_TYPE, ALL_VEHICLE } from "../types/index";
import { vehicleTypeService, } from "../../services/index";
import { createAsyncThunk } from '@reduxjs/toolkit';

export type VehicleTypeRequestPayload = {
  locations: { lat: number; lng: number }[];
  service_id?: any;
  service_category_id?: any;
  current_time?: string;
};

export const vehicleTypeDataGet = createAsyncThunk(
  VEHICLE_TYPE,
  async (data: VehicleTypeRequestPayload) => {
    const response = await vehicleTypeService.vehicleTypes(data);
    return response?.data;
  }
);


export const vehicleData = createAsyncThunk(ALL_VEHICLE, async () => {
  const response = await vehicleTypeService.allVehicleData();  
  return response?.data;
},
);
