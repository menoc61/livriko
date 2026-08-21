import { carpoolingOffer, carpoolingOfferSearch } from '../endpoints/carpoolingOfferEndPoint'
import { GET_API, POST_API } from '../methods'

export const searchCarpoolingOffers = async (params?: any) => {
  const queryParams = new URLSearchParams()
  if (params?.pickup_lat) queryParams.append('pickup_lat', params.pickup_lat)
  if (params?.pickup_lng) queryParams.append('pickup_lng', params.pickup_lng)
  if (params?.dropoff_lat) queryParams.append('dropoff_lat', params.dropoff_lat)
  if (params?.dropoff_lng) queryParams.append('dropoff_lng', params.dropoff_lng)
  if (params?.vehicle_type_id) queryParams.append('vehicle_type_id', params.vehicle_type_id)
  if (params?.min_seats) queryParams.append('min_seats', params.min_seats)
  if (params?.date) queryParams.append('date', params.date)
  if (params?.available_area) queryParams.append('available_area', params.available_area)

  const queryString = queryParams.toString()
  const endpoint = queryString ? `${carpoolingOfferSearch}?${queryString}` : carpoolingOfferSearch

  return GET_API(endpoint)
    .then(res => res)
    .catch(e => e?.response)
}

export const getCarpoolingOffer = async (offerId: number) => {
  return GET_API(`${carpoolingOffer}/${offerId}`)
    .then(res => res)
    .catch(e => e?.response)
}

export const bookCarpoolingOffer = async (offerId: number, data: { seats?: number; payment_method?: string }) => {
  return POST_API(data, `${carpoolingOffer}/${offerId}/book`)
    .then(res => res)
    .catch(e => e?.response)
}

const carpoolingOfferService = {
  searchCarpoolingOffers,
  getCarpoolingOffer,
  bookCarpoolingOffer,
}

export default carpoolingOfferService
