import './assets/css/main.css'
import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import NavBar from './components/NavBar.vue'
import Footer from './components/footer.vue'
import { RouterLink, RouterView } from 'vue-router'
const app = createApp(App)
app.use(router)
app.component('NavBar', NavBar)
app.component('Footer', Footer)
app.component('RouterLink', RouterLink)
app.component('RouterView', RouterView)
app.mount('#app')
