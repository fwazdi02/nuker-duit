<script setup>
import { ref, watch, onMounted } from 'vue'
const props = defineProps(['modelValue'])
const selectedValue = ref('')
const options = ref([
  {
    label: 'US Dollar',
    value: 'usd'
  },
  {
    label: 'Australian Dollar',
    value: 'aud'
  },
  {
    label: 'Japan Yen',
    value: 'jpy'
  }
])
options.value.unshift({ label: 'Select Currency', value: '' })

watch(props, () => {
  selectedValue.value = props.modelValue
})

onMounted(() => {
  selectedValue.value = props.modelValue
})
</script>
<template>
  <n-select
    v-model:value="selectedValue"
    :options="options"
    placeholder="Select currency"
    :consistent-menu-width="false"
    :default-value="''"
    :reset-menu-on-options-change="false"
  />
</template>
