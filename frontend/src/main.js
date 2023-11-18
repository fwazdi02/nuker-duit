import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import naiveUI from 'naive-ui'

const app = createApp(App)

app.use(createPinia())
app.use(router)
app.use(naiveUI)

app.mount('#app')
