import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import axios from "./plugins/axios";
import "./index.css";

const publicEnvVar = import.meta.env;

const app = createApp(App);

app.use(router);

app.use(axios, {
  baseUrl: publicEnvVar.VITE_WEATHER_INFORMATION_BASE_URL,
});

app.mount("#app");
