import http from './http.js'

const authLogin = async (payload) => {
  try {
    const response = await http.post('/auth/login', payload)
    return response
  } catch (error) {
    const message = error.response?.data?.message || error.message
    console.log(message)
    window.$message.error(message)
  }
}

const getRecentTransaction = async () => {
  try {
    const response = await http.get('/recent-transaction')
    return response
  } catch (error) {
    const message = error.response?.data?.message || error.message
    console.log(message)
    window.$message.error(message)
  }
}

const getCurrencies = async () => {
  try {
    const response = await http.get('/currencies')
    return response
  } catch (error) {
    const message = error.response?.data?.message || error.message
    console.log(message)
    window.$message.error(message)
  }
}
const getExchangeRate = async (payload) => {
  try {
    const response = await http.post('/rate', payload)
    return response
  } catch (error) {
    const message = error.response?.data?.message || error.message
    console.log(message)
    window.$message.error(message)
  }
}

const submitExchange = async (payload) => {
  try {
    const response = await http.post('/exchange', payload)
    return response
  } catch (error) {
    const message = error.response?.data?.message || error.message
    console.log(message)
    window.$message.error(message)
  }
}

const getSummaries = async (query='') => {
  try {
    const response = await http.get(`/summaries/${query}`)
    return response
  } catch (error) {
    const message = error.response?.data?.message || error.message
    console.log(message)
    window.$message.error(message)
  }
}


export { authLogin, getCurrencies, getExchangeRate, getRecentTransaction, getSummaries, submitExchange }