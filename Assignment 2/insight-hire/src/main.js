import { createApp } from "vue";
import App from "./App.vue";
// Import router from index.js
import router from "./router";
// Vuetify
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";
import { VDateInput } from "vuetify/labs/VDateInput";
// MDI icon for Vuetify
import { aliases, mdi } from "vuetify/iconsets/mdi-svg";
import { mdiAccount } from "@mdi/js";

const vuetify = createVuetify({
  components: {
    ...components,
    VDateInput,
  },
  directives,
  icons: {
    defaultSet: "mdi",
    aliases: {
      ...aliases,
      account: mdiAccount,
    },
    sets: {
      mdi,
    },
  },
});

import "./assets/style.scss"; // Custom css
const app = createApp(App);
app.use(router); // Use router on app
app.use(vuetify);
app.mount("#app");
import "bootstrap/dist/js/bootstrap.bundle.js";
