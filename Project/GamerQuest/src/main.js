import { createApp } from "vue";
import router from "./router";
import App from "./App.vue";

// Vuetify
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

const vuetify = createVuetify({
  components: {
    ...components,
  },
  directives,
  // icons: {
  //     defaultSet: "mdi",
  //     aliases: {
  //         ...aliases,
  //         account: mdiAccount,
  //     },
  //     sets: {
  //         mdi,
  //     },
  // },
});

import "./assets/style.scss"; // Custom css
const app = createApp(App);
app.use(router); // Use router on app
app.use(vuetify);
app.mount("#app");
import "bootstrap/dist/js/bootstrap.bundle.js";
