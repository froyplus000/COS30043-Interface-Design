import { createMemoryHistory, createRouter } from "vue-router";
// Views
import HomeView from "../views/HomeView.vue";
import AboutView from "../views/AboutView.vue";
import NewsView from "../views/NewsView.vue";
import SignUpView from "../views/SignUpView.vue";
import LogInView from "../views/LogInView.vue";
// Components

const routes = [
  {
    path: "/",
    component: HomeView,
  },
  { path: "/about", component: AboutView },
  { path: "/news", component: NewsView },
  { path: "/signup", component: SignUpView },
  { path: "/login", component: LogInView },
];

const router = createRouter({
  history: createMemoryHistory(),
  routes,
});
export default router;
