export interface CancelationInterface {
    success?: boolean;
    loading?: boolean;
    canceldata?: cancelationDataInterface[];
    cancelationValue?: cancelationDataInterface;
}

export interface cancelationDataInterface{
    id?: number;
    title?: string;
    reason?: string;
    [key: string]: any;
}