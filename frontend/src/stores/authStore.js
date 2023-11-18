import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

export const useAuthStore = defineStore('authStore', () => {
  const token = ref(0)
  const user = ref({
    email:'',
    name:''
  })
  
  const isLoggedIn = computed(() => !!user.value.email && !!token.value)

  function setToken(val) {
    token.value = val
  }
  function setUser(val) {
    user.value = val
  }

  return { token, user, setToken, setUser, isLoggedIn }
})
