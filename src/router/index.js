import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Login from '../views/Login.vue'
import poll from '../views/Poll.vue'
import NotFound from '../views/404.vue'
import test from '../views/test.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/poll',
      name: 'poll',
      component: poll
    },
    {
      path: '/test',
      component: test
    },
    {
      path: '/:pathMatch(.*)*',
      component: NotFound
    }
  ]
})

export default router
