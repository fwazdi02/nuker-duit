<script setup>
const inverted = ref(false)
import { useRoute, RouterLink } from 'vue-router'
import { h, ref } from 'vue'
import { NIcon } from 'naive-ui'
import {
  HomeFilled,
  DisplaySettingsOutlined,
  DownloadOutlined,
  UploadOutlined
} from '@vicons/material'

const route = useRoute()
const activeKey = ref(route.name)

function renderIcon(icon) {
  return () => h(NIcon, null, { default: () => h(icon) })
}

const renderLabel = (label, key) => {
  return () => h(RouterLink, { to: { name: key } }, { default: () => label })
}

const menuOptions = [
  {
    label: renderLabel('Dashboard', 'dashboard'),
    key: 'dashboard',
    icon: renderIcon(HomeFilled)
  },
  {
    label: renderLabel('Buy Transaction', 'buy'),
    key: 'buy',
    icon: renderIcon(DownloadOutlined)
  },
  {
    label: renderLabel('Sell Transaction', 'sell'),
    key: 'sell',
    icon: renderIcon(UploadOutlined)
  },
  {
    label: renderLabel('Summary', 'summary'),
    key: 'summary',
    icon: renderIcon(DisplaySettingsOutlined)
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
            v-model:value="activeKey"
            :inverted="inverted"
            :collapsed-width="64"
            :collapsed-icon-size="22"
            :options="menuOptions"
          />
        </n-layout-sider>
        <n-layout class="p-4">
          <router-view />
        </n-layout>
      </n-layout>
    </n-layout>
  </div>
</template>

<style></style>
