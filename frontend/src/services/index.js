import http from './http.js'

export const authLogin = async (payload) => {
  try {
    const response = await http.post('/auth/login', payload)
    return response
  } catch (error) {
    const message = error.response?.data?.message || error.message
    console.log(message)
    window.$message.error(message)
  }
}
