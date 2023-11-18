import axios from 'axios'
const prefix = import.meta.env.VITE_PREFIX_TOKEN
import { useAuthStore } from '@/stores/authStore'

const http = axios.create({
  baseURL: import.meta.env.VITE_API_ENDPOINT,
  headers: {
    'Content-Type': 'application/json'
  }
})

http.interceptors.request.use(
  async (config) => {
    config.headers.Authorization = `Bearer ${await useAuthStore().token}`
    return config
  },
  (error) => {
    Promise.reject(error)
  }
)

http.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      localStorage.removeItem(`${prefix}name`)
      localStorage.removeItem(`${prefix}token`)
      localStorage.removeItem(`${prefix}refresh_token`)
      // window.location.href = '/login'
    }
    return Promise.reject(error)
  }
)

export default http
