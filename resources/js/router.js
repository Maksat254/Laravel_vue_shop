import { createRouter, createWebHistory } from "vue-router";
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.bundle.js';

const routes = [
    {
        path: "/",
        component: () => import("./pages/HomeRoute.vue"),
    },
    {
        path: "/test",
        component: () => import("./pages/TestRoute.vue"),
    },
    {
        path: "/create",
        component:()=> import("./pages/ProductCreate.vue"),
    },
    {
        path: "/cart",
        component:()=>import("./pages/Cart_item.vue")
    },
    {
        path: "/product/detale/:id",
        component:()=>import("./pages/ProductDetale.vue")
    },

    {
        path: "/register",
        component:()=>import('./pages/AuthComponent.vue')
    },

    {
        path: "/login",
        component:()=>import('./pages/Login.vue')
    },
    {
        path: "/orders",
        component:()=>import('./pages/Order.vue')
    },
];


export default createRouter({
    history: createWebHistory(),
    routes,
});
