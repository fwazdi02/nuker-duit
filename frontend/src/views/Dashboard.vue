<script setup>
import { ref, onMounted } from 'vue'
import { getRecentTransaction } from '@/services';

const isLoading = ref(false)
const transactions = ref([])

const fetchTransactions = async () => {
  isLoading.value = true
  const response = await getRecentTransaction()
  if(response.data){
    transactions.value = response.data.data
  }
  setTimeout(() => {
    isLoading.value = false
  }, 500)
}

onMounted(() => {
  fetchTransactions()
})


</script>

<template>
  <div class="">
  <n-spin :show="isLoading" class="min-h-[300px]">
    <div class=" flex flex-1 gap-4">
      <n-card class="w-1/5 inline-flex" :title="transaction?.code.toUpperCase()" v-for="(transaction, index) in transactions" :key="index">
        <p class="text-3xl my-0 text-red-400">{{ transaction.rate  }}</p>
      </n-card>
    </div>
    </n-spin>
  </div>
</template>

<style></style>
