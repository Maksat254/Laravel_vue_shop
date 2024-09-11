import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("../pages/HomeRoute.vue"),
    },
    {
        path: "/cart",
        component:()=>import("../pages/Cart_item.vue")
    }

];


export default createRouter({
    history: createWebHistory(),
    routes,
});
