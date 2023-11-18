<script setup>
import { ref } from 'vue'
const options = ref([
  {
    label: 'Drive My Car',
    value: 'song1'
  },
  {
    label: 'Norwegian Wood',
    value: 'song2'
  },
  {
    label: "You Won't See",
    value: 'song3'
  },
  {
    label: 'Nowhere Man',
    value: 'song4'
  },
  {
    label: 'Think For Yourseld',
    value: 'song5'
  }
])

const isLoading = ref(false)
const model = ref({
  currency_id: null,
  amount: 0,
  idr: 0
})

// const validatorInput = (x) => x > 0
</script>

<template>
  <div>
    <n-card title="Transaction Buy" class="md:w-2/3">
      <div class="flex flex-col gap-2">
        <div class="flex flex-col gap-1">
          <label>Currency</label>
          <n-select
            v-model:value="model.currency_id"
            :options="options"
            :reset-menu-on-options-change="false"
          />
        </div>
        <div class="flex flex-col gap-1">
          <label>Amount</label>
          <n-input v-model:value="model.amount" type="number" />
        </div>
        <div class="flex flex-col gap-1">
          <label>Total IDR</label>
          <n-input v-model:value="model.idr" type="number" disabled />
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
