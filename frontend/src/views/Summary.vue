<script setup>
import { ref, onMounted } from 'vue'
import { getSummaries } from '@/services';

const isLoading = ref(false)
const summaries = ref([])

const fetchSummaries = async () => {
  isLoading.value = true
  const response = await getSummaries()
  if(response.data){
    summaries.value = response.data.data
  }
  setTimeout(() => {
    isLoading.value = false
  }, 500)
}

onMounted(() => {
  fetchSummaries()
})


</script>

<template>
  <div>
    <n-card title="Summary">
      <n-spin :show="isLoading">
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
              <td> {{  item.total_buy  }}</td>
              <td> {{  item.total_sell  }}</td>
              <td>{{  item.saldo  }}</td>
            </tr>
          </tbody>
        </n-table>
      </n-spin>
      </n-card>
  </div>
</template>

<style></style>
