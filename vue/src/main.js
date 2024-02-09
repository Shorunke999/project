import { createApp } from 'vue'
import store from './store'
import router from './router/index.js'
import './style.css'
import App from './App.vue'

createApp(App)
.use(router)
.use(store)
.mount('#app')
