import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import Cookies from 'js-cookie'

const prefix = import.meta.env.VITE_PREFIX_TOKEN


export const useAuthStore = defineStore('authStore', () => {
  const _user = Cookies.get(`${prefix}user`)
  const _token = Cookies.get(`${prefix}token`)
  const token = ref('')
  const user = ref({
    email: '',
    name: ''
  })

  if(_token){
    setToken(_token)
  }

  if(_user){
    const parsedUser = JSON.parse(_user)
    setUser(parsedUser)
  }

  
  const isLoggedIn = computed(() => !!user.value.email && !!token.value)

  function setToken(val) {
    token.value = val
    Cookies.set(`${prefix}token`, val)
  }

  function setUser(val) {
    user.value = val
    Cookies.set(`${prefix}user`, JSON.stringify(val))
  }

  function setAuthLogin({ user, token }){
    setToken(token)
    setUser(user)
  }
  
  function setAuthLogout(){
    token.value = ''
    user.value = {
      email: '',
      name: ''
    }
    Cookies.remove(`${prefix}token`)
    Cookies.remove(`${prefix}user`)
  }

  return { token, user, setToken, setUser, setAuthLogin, setAuthLogout, isLoggedIn }
})
