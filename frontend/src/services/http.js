import axios from 'axios'
const prefix = import.meta.env.VITE_PREFIX_TOKEN

const http = axios.create({
  baseURL: import.meta.env.VITE_API_ENDPOINT,
  headers: {
    'Content-Type': 'application/json'
  }
})

http.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      localStorage.removeItem(`${prefix}name`)
      localStorage.removeItem(`${prefix}token`)
      localStorage.removeItem(`${prefix}refresh_token`)
      window.location.href = '/login'
    }
    return Promise.reject(error)
  }
)

export default http
