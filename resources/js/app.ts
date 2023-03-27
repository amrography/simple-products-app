import { createApp } from "vue";
import VueApp from "./App.vue";
import router from "./routes";
import axios from "./axios";

const app = createApp(VueApp);

app.use(router);
app.use(axios, {
  baseUrl: "/api",
});

app.mount("#app");
