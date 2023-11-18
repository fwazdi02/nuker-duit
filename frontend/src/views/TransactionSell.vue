<script setup>
import { ref } from 'vue'
import AjaxCurrency from '../components/AjaxCurrency.vue'

const isLoading = ref(false)
const model = ref({
  currency_code: 'jpy',
  amount: 0,
  idr: 0
})
</script>

<template>
  <div>
    <n-card title="Sell Transaction" class="md:w-2/3">
      <div class="flex flex-col gap-2">
        <div class="flex flex-col gap-1">
          <label>Currency</label>
          <AjaxCurrency v-model="model.currency_code"></AjaxCurrency>
        </div>
        <div class="flex flex-col gap-1">
          <label>Amount</label>
          <n-input v-model="model.amount" type="number" />
        </div>
        <div class="flex flex-col gap-1">
          <label>Total IDR</label>
          <n-input v-model="model.idr" type="number" disabled />
        </div>
      </div>
      <template #footer>
        <div class="flex justify-end gap-2">
          <n-button type="default">Reset</n-button>
          <n-button type="primary" :loading="isLoading">Submit</n-button>
        </div>
      </template>
    </n-card>
  </div>
</template>

<style></style>
