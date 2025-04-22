import { createApp } from "vue";
import App from "./App.vue";
import "./assets/style.scss";
// Import router from index.js
import router from "./router";
const app = createApp(App);
app.use(router); // Use router on app
app.mount("#app");
import "bootstrap/dist/js/bootstrap.bundle.js";
