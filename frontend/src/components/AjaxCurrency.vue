<script setup>
import { getCurrencies } from '@/services'
import { ref, watch, onMounted } from 'vue'
const props = defineProps(['modelValue'])
const emit = defineEmits(['update:modelValue'])
const selectedValue = ref('')
const options = ref([])
const isLoading = ref(false)

const fetchCurrencies = async () => {
  isLoading.value = true
  const response = await getCurrencies().finally(() => {
    isLoading.value = false
  })
  if (response.data) {
    options.value = response.data.data.map((item) => {
      return { label: `${item.code.toUpperCase()} - ${item.name}`, value: item.code }
    })
  }
}

watch(props, () => {
  selectedValue.value = props.modelValue
})

watch(selectedValue, () => {
  emit('update:modelValue', selectedValue.value)
})

onMounted(async () => {
  await fetchCurrencies()
  if (props.modelValue) {
    selectedValue.value = props.modelValue
  }
  options.value.unshift({ label: 'Select Currency', value: '' })
})
</script>
<template>
  <n-select
    :loading="isLoading"
    :disabled="isLoading"
    v-model:value="selectedValue"
    :options="options"
    placeholder="Select currency"
    :consistent-menu-width="false"
    :default-value="''"
    :reset-menu-on-options-change="false"
  />
</template>
