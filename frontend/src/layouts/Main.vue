<script setup>
import { useRoute, RouterLink, useRouter } from 'vue-router'
import { h, ref, watch } from 'vue'
import { NIcon } from 'naive-ui'
import { useAuthStore } from '@/stores/authStore'

import {
  HomeFilled,
  DisplaySettingsOutlined,
  DownloadOutlined,
  UploadOutlined,
  LogOutFilled
} from '@vicons/material'
import { useMessage } from 'naive-ui'
window.$message = useMessage()



const authStore = useAuthStore()
const route = useRoute()
const router = useRouter()

const activeKey = ref(route.name)
const inverted = ref(false)

function renderIcon(icon) {
  return () => h(NIcon, null, { default: () => h(icon) })
}

const renderLabel = (label, key) => {
  return () => h(RouterLink, { to: { name: key } }, { default: () => label })
}

const handleLogout = () =>{
  authStore.setAuthLogout()
  window.$message.success('Logout success')
  router.push({ name: 'login' })
}

watch(activeKey, () =>{
  if(activeKey.value === 'logout'){
    handleLogout()
  }
})

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
  },
  {
    label: 'Logout',
    key: 'logout',
    icon: renderIcon(LogOutFilled)
  }
]
</script>

<template>
  <div class="h-screen">
    <n-layout>
      <n-layout-header :inverted="inverted" bordered class="h-[56px]">
        <div class="flex items-center justify-between h-full px-4 text-green-600">
          <p class="text-xl font-bold my-0">NukerDuit!</p>
          <div class="flex items-center gap-4">
            Admin
            <n-avatar
              round
              size="medium"
              src="https://07akioni.oss-cn-beijing.aliyuncs.com/07akioni.jpeg"
            />
          </div>
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
