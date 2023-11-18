<script setup>
const inverted = ref(false)
import { h, ref } from 'vue'
import { NIcon } from 'naive-ui'
import { AdjustOutlined } from '@vicons/material'

function renderIcon(icon) {
  return () => h(NIcon, null, { default: () => h(icon) })
}

const menuOptions = [
  {
    label: 'Dashboard',
    key: 'dashboard',
    icon: renderIcon(AdjustOutlined)
  },
  {
    label: 'Buy Transaction',
    key: 'buy-transaction',
    icon: renderIcon(AdjustOutlined)
  },
  {
    label: 'Sell Transaction',
    key: 'sell-transaction',
    icon: renderIcon(AdjustOutlined)
  },
  {
    label: 'Summary',
    key: 'summary',
    icon: renderIcon(AdjustOutlined)
  }
]
</script>

<template>
  <div class="h-screen">
    <n-layout>
      <n-layout-header :inverted="inverted" bordered class="h-[56px]">
        <div class="flex items-center h-full px-4 text-green-600">
          <p class="text-xl font-bold my-0">NukerDuit!</p>
        </div>
      </n-layout-header>
      <n-layout has-sider>
        <n-layout-sider
          bordered
          show-trigger
          collapse-mode="width"
          :collapsed-width="64"
          :width="240"
          :native-scrollbar="false"
          :inverted="inverted"
          class="h-[calc(100vh-56px)] bg-green-50"
        >
          <n-menu
            :inverted="inverted"
            :collapsed-width="64"
            :collapsed-icon-size="22"
            :options="menuOptions"
          />
        </n-layout-sider>
      </n-layout>
    </n-layout>
  </div>
</template>

<style></style>
