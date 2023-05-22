import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import Login from "../views/Login.vue";
import NotFound from "../views/404.vue";
import PollList from "../views/PollList.vue";
import EditPoll from "../views/EditPoll.vue";
import CreatePoll from "../views/CreatePoll.vue";
import VotePoll from "../views/VotePoll.vue";
import Poll from "../views/Poll.vue";
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
      path: "/polledit",
      component: EditPoll,
    },
    {
      path: "/pollcreate",
      component: CreatePoll,
    },
    {
      path: "/pollvote",
      component: VotePoll,
    },
  ],
});
export default router;
