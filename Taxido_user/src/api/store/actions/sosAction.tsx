import { SOS, SOSAlert } from "../types/index";
import { SOSAlertDataInterface, SOSInterface } from "../../interface/sosInterface";
import { createAsyncThunk } from '@reduxjs/toolkit';
import { sosServices } from "@src/api/services";


export const sosData = createAsyncThunk(
  SOS,
  async (data: number | { zone_id: number }) => {
    const zone_id = typeof data === 'number' ? data : data.zone_id;
    const response = await sosServices.sosData(zone_id);
    return response?.data;
  },
);



export const sosAlertData = createAsyncThunk(
  SOSAlert,
  async (data: SOSAlertDataInterface) => {
    const response = await sosServices.sosAlertData(data);
    return response?.data;
  },
);
