import { createMemoryHistory, createRouter } from "vue-router";
// Views

import JobExplorerView from "../views/JobExplorerView.vue";
import JobApplicationView from "../views/JobApplicationView.vue";
import ToDoView from "../views/ToDoView.vue";
// Components
import JobOverview from "../components/JobOverview.vue";
import JobDetail from "../components/JobDetail.vue";

const routes = [
  {
    path: "/",
    component: JobExplorerView,
    children: [
      { path: "", component: JobOverview }, // default route
      { path: ":jobId", component: JobDetail }, // dynamic job detail
    ],
  },
  { path: "/jobApplication", component: JobApplicationView },
  { path: "/toDoList", component: ToDoView },
];

const router = createRouter({
  history: createMemoryHistory(),
  routes,
});
export default router;
