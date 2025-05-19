import { createMemoryHistory, createRouter } from "vue-router";
// Views
import HomeView from "../views/HomeView.vue";
import AboutView from "../views/AboutView.vue";
import NewsView from "../views/NewsView.vue";
import SignUpView from "../views/SignUpView.vue";
import LogInView from "../views/LogInView.vue";
import GameExplorerView from "../views/GameExplorerView.vue";
import GameDetailView from "../views/GameDetailView.vue";
import ProfileView from "../views/ProfileView.vue";
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
  // Game Explorer and Game Detail
  { path: "/explorer", component: GameExplorerView },
  { path: "/explorer/:gameId", component: GameDetailView },
  { path: "/profile", component: ProfileView },
];

const router = createRouter({
  history: createMemoryHistory(),
  routes,
});
export default router;
