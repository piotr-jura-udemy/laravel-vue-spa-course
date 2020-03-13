import VueRouter from "vue-router";
import Basket from "./basket/Basket";
import Bookable from "./bookable/Bookable";
import Bookables from "./bookables/Bookables";
import Review from "./review/Review";
import { isLoggedIn } from "./shared/utils/auth";

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
    },
    {
        path: "/auth/reset",
        component: require("./auth/RequestResetPassword").default,
        name: "password-reset"
    },
    {
        path: "/auth/reset/:token",
        component: require("./auth/ResetPassword").default,
        name: "password-reset-token"
    },
    {
        path: "/account/trips",
        component: require("./myaccount/Trips").default,
        name: "trips",
        meta: {
            requiresAuth: true
        }
    }
];

export default function router(store) {
    const router = new VueRouter({
        routes, // short for `routes: routes`
        mode: "history"
    });

    router.beforeEach((to, from, next) => {
        console.log('route');
        if (to.matched.some(record => record.meta.requiresAuth)) {
            if (!isLoggedIn()) {
                next({ name: "login" });
            } else {
                next();
            }
        } else {
            next();
        }
    });

    return router;
};
