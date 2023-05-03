import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import NavBar from './components/NavBar.vue'
import Footer from './components/Footer.vue'
import VueCookie from 'vue-cookies'
import axios from 'axios'

const app = createApp(App)
app.component('NavBar', NavBar)
app.component('Footer', Footer)
app.use(axios)
app.use(VueCookie)
app.use(router)
app.mount('#app')