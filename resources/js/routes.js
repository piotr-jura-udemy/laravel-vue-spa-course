import VueRouter from "vue-router";
import Basket from "./basket/Basket";
import Bookable from "./bookable/Bookable";
import Bookables from "./bookables/Bookables";
import Review from "./review/Review";

const routes = [
    {
        path: "/",
        component: Bookables,
        name: "home"
    },
    {
        path: "/bookable/:id",
        component: Bookable,
        name: "bookable"
    },
    {
        path: "/review/:id",
        component: Review,
        name: "review"
    },
    {
        path: "/basket",
        component: Basket,
        name: "basket"
    },
    {
        path: "/auth/login",
        component: require("./auth/Login").default,
        name: "login"
    },
    {
        path: "/auth/register",
        component: require("./auth/Register").default,
        name: "register"
    }
];

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: "history"
});

export default router;
