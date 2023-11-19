<script setup>
import { ref, onMounted, watch } from 'vue'
import { getSummaries } from '@/services'

const isLoading = ref(false)
const summaries = ref([])

const fetchSummaries = async () => {
  isLoading.value = true
  const query = new URLSearchParams({'data_in': filter.value})
  console.log(query.toString())
  const response = await getSummaries(`?${query.toString()}`)
  if (response.data) {
    summaries.value = response.data.data
  }
  setTimeout(() => {
    isLoading.value = false
  }, 500)
}


const filter = ref('daily')
watch(filter, () => {
  fetchSummaries()
})

const options = ref([
  {
    label: 'Daily',
    value: 'daily'
  },
  {
    label: 'Weekly',
    value: 'weekly'
  },
  {
    label: 'Monthly',
    value: 'monthly'
  }
])

onMounted(() => {
  fetchSummaries()
})
</script>

<template>
  <div>
    <n-card title="Summary">
      <n-spin :show="isLoading">
        <div class="mb-3">
          <n-select
          class="w-24"
          :disabled="isLoading"
          v-model:value="filter"
          :options="options"
          :consistent-menu-width="true"
          :default-value="'daily'" />
        </div>
        <n-table :bordered="false" :single-line="false">
          <thead>
            <tr>
              <th>Currency</th>
              <th>Total Buy</th>
              <th>Total Sell</th>
              <th>Available Amount</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in summaries" :key="index">
              <td class="uppercase">{{ item.code }}</td>
              <td>{{ item.total_buy }}</td>
              <td>{{ item.total_sell }}</td>
              <td>{{ item.saldo }}</td>
            </tr>
          </tbody>
        </n-table>
      </n-spin>
    </n-card>
  </div>
</template>

<style></style>
