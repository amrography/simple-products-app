import axios from "axios";
import type { App } from "vue";

interface AxiosOptions {
  baseUrl?: string;
}

export default {
  install: (app: App, options: AxiosOptions) => {
    app.config.globalProperties.$axios = axios.create({
      baseURL: options.baseUrl,
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
    });
  },
};
