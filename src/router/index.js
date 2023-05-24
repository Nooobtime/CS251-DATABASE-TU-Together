import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import Login from "../views/Login.vue";
import NotFound from "../views/404.vue";
import PollList from "../views/PollList.vue";
import Poll from "../views/Poll.vue";
import requestcreate from "../views/requestcreate.vue";
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      component: HomeView,
    },
    {
      path: "/:pathMatch(.*)*",
      component: NotFound,
    },
    {
      path: "/login",
      component: Login,
    },
    {
      path: "/poll",
      component: Poll,
    },
    {
      path: "/polllist",
      component: PollList,
    },
    {
      path: "/requestcreate",
      component: requestcreate,
    },
  ],
});

export default router;
