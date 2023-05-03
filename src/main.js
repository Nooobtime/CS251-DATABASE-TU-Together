import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import NavBar from './components/NavBar.vue'
import Footer from './components/Footer.vue'

const app = createApp(App)
app.component('NavBar', NavBar)
app.component('Footer', Footer)
app.use(router)
app.mount('#app')