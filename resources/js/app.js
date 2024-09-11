import "./bootstrap";
import router from "./router";
import { createApp } from "vue";
import ProductCreate from "./pages/ProductCreate.vue";
import App from "./App.vue";
import store from './index.js'



createApp(App).use(router).mount("#app");

// const app = createApp({});
// app.component('product-create', ProductCreate);

// app.use(router)
// app.use(store)
// app.mount('#app');
