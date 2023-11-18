<script setup>
import { authLogin } from '@/services'
import { useAuthStore } from '@/stores/authStore'
import { useRouter } from 'vue-router'
import { ref } from 'vue'
import { useMessage } from 'naive-ui'
window.$message = useMessage()


const router = useRouter()
const isLoading = ref(false)
const authStore = useAuthStore()

const model = ref({
  email: null,
  password: null
})
const isValidEmail = (value) => {
  return value.match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
          )
}

const rules = {
  email: [
    {
      required: true,
      validator(rules, value) {
        if (!value) return new Error('Email is required')
        const status =
          value && isValidEmail(value)
        if (!status) {
          return new Error('Email is invalid')
        }
        return true
      },
      trigger: ['input', 'blur']
    }
  ],
  password: [
    {
      required: true,
      message: 'Password is required',
      trigger: ['input', 'blur']
    }
  ]
}

const handleSubmit = async () => {
  isLoading.value = true
  const response = await authLogin(model.value)
  if (response.data) {
    const { user, access_token }= response.data.data
    authStore.setAuth({ user, token: access_token })
    window.$message.success(`Welcome back, ${user?.name}`)
    router.push({ name: 'dashboard' })
  }
  setTimeout(() => {
    isLoading.value = false
  }, 1000);
}
</script>

<template>
  <div class="">
    <div class="h-screen flex flex-col items-center justify-center px-4">
      <n-card class="w-full md:w-1/3 lg:1/4 xl:w-3/12 mx-auto">
        <p class="text-2xl font-bold mt-0 mb-1 text-green-600">NukerDuit!</p>
        <p class="text-lg text-slate-400 mt-0">Please, enter your account</p>
        <n-form ref="formRef" :model="model" :rules="rules">
          <n-form-item path="email" label="Email">
            <n-input v-model:value="model.email" type="email" @keydown.enter.prevent />
          </n-form-item>
          <n-form-item path="password" label="Password">
            <n-input v-model:value="model.password" type="password" @keydown.enter.prevent />
          </n-form-item>
          <div class="flex justify-end">
            <div class="flex gap-3">
              <n-button type="default"> Reset </n-button>
              <n-button
                :loading="isLoading"
                :disabled="!model.email || !model.password || !isValidEmail(model.email)"
                type="primary"
                @click="handleSubmit"
              >
                Login
              </n-button>
            </div>
          </div>
        </n-form>
      </n-card>
    </div>
  </div>
</template>
