<script setup>
import { ref, reactive, computed, watch } from 'vue'
import AjaxCurrency from '@/components/AjaxCurrency.vue'
import { getExchangeRate, submitExchange } from '@/services'

import debounce from 'lodash.debounce'

const isLoading = ref(false)
const model = reactive({
  code: '',
  amount: 0
})
const idr = ref('0')

const fetchExchangeRate = async () => {
  const payload = {
    code: model.code,
    amount: model.amount,
    type: 'buy'
  }
  const response = await getExchangeRate(payload)
  if (response.data) {
    const { data } = response.data
    idr.value = (data.idr * model.amount).toFixed(2)
  }
}

const fetchSubmitExchange = async () => {
  isLoading.value = true
  const payload = {
    code: model.code,
    amount: model.amount,
    type: 'sell'
  }
  const response = await submitExchange(payload)
  if (response.data) {
    window.$message.success(response.data.message)
    handleReset()
  }
  setTimeout(() => {
    isLoading.value = false
  }, 500)
}

const handleReset = () => {
  model.code = ''
  model.amount = 0
  idr.value = '0'
}

const resultRupiah = computed(() => {
  return parseInt(idr.value).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })
})

watch(
  model,
  debounce(() => {
    if (!!model.code && !!model.amount) fetchExchangeRate()
  }, 500)
)
</script>

<template>
  <div>
    <n-card title="Sell Transaction" class="md:w-2/3">
      <div class="flex flex-col gap-2">
        <div class="flex flex-col gap-1">
          <label>Currency</label>
          <AjaxCurrency v-model="model.code"></AjaxCurrency>
        </div>
        <div class="flex flex-col gap-1">
          <label>Amount</label>
          <n-input v-model:value="model.amount" type="number" />
        </div>
        <div class="flex flex-col gap-1">
          <label>Total IDR</label>
          <n-input :value="resultRupiah" type="text" disabled />
        </div>
      </div>
      <template #footer>
        <div class="flex justify-end gap-2">
          <n-button type="default" @click="handleReset">Reset</n-button>
          <n-button
            type="primary"
            :loading="isLoading"
            @click="fetchSubmitExchange"
            :disabled="!!!model.code || !!!model.amount"
            >Submit</n-button
          >
        </div>
      </template>
    </n-card>
  </div>
</template>

<style></style>
