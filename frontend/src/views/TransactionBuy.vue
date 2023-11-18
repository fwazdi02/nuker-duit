<script setup>
import { ref, reactive, computed } from 'vue'
import AjaxCurrency from '@/components/AjaxCurrency.vue'
import { getExchangeRate } from '@/services';

const isLoading = ref(false)
const model = reactive({
  code: '',
  amount: 0,
  idr: '0'
})

const fetchExchangeRate = async () => {
  const payload = {
    code: model.code,
    amount: model.amount,
    type: 'buy'
  }
  const response = await getExchangeRate(payload)
  if(response.data){
    const { data } = response.data
    model.idr = (data.idr * model.amount).toFixed(2);
  }
}

const resultRupiah = computed(() => {
  return parseInt(model.idr).toLocaleString("id-ID", { style: "currency", currency: "IDR"})
})


</script>

<template>
  <div>
    <n-card title="Buy Transaction" class="md:w-2/3">
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
          <n-button type="default" @click="fetchExchangeRate">Reset</n-button>
          <n-button type="primary" :loading="isLoading">Submit</n-button>
        </div>
      </template>
    </n-card>
  </div>
</template>

<style></style>
