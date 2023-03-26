import { createApp } from "vue";
import VueApp from "./App.vue";
import router from "./routes.ts";

const app = createApp(VueApp);

app.use(router)

app.mount("#app");
