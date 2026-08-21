import { carpoolingOffer } from '../endpoints/carpoolingOfferEndPoint'
import { GET_API, POST_API, PUT_API, DELETE_API } from '../methods'

export const getCarpoolingOffers = async () => {
  return GET_API(`${carpoolingOffer}`)
    .then(res => {
      return res
    })
    .catch(e => {
      return e?.response
    })
}

export const getCarpoolingOffer = async (offerId: number) => {
  return GET_API(`${carpoolingOffer}/${offerId}`)
    .then(res => {
      return res
    })
    .catch(e => {
      return e?.response
    })
}

export const createCarpoolingOffer = async (data: any) => {
  return POST_API(data, `${carpoolingOffer}`)
    .then(res => {
      return res
    })
    .catch(e => {
      return e?.response
    })
}

export const updateCarpoolingOffer = async (offerId: number, data: any) => {
  return PUT_API(data, `${carpoolingOffer}/${offerId}`)
    .then(res => {
      return res
    })
    .catch(e => {
      return e?.response
    })
}

export const deleteCarpoolingOffer = async (offerId: number) => {
  return DELETE_API(`${carpoolingOffer}/${offerId}`)
    .then(res => {
      return res
    })
    .catch(e => {
      return e?.response
    })
}

const carpoolingOfferService = {
  getCarpoolingOffers,
  getCarpoolingOffer,
  createCarpoolingOffer,
  updateCarpoolingOffer,
  deleteCarpoolingOffer,
}

export default carpoolingOfferService
