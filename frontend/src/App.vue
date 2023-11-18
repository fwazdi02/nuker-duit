<script setup>
const themeOverrides = {
  common: {
    borderRadius: '6px',
    borderRadiusSmall: '3px'
  }
}
</script>

<template>
  <NConfigProvider :theme-overrides="themeOverrides">
    <NMessageProvider>
      <RouterView />
    </NMessageProvider>
  </NConfigProvider>
</template>
