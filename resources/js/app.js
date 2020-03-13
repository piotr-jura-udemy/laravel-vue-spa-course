require("./bootstrap");

import moment from "moment";
import VueRouter from "vue-router";
import Vuex from 'vuex';
import Index from "./Index";
import router from "./routes";
import ColumnView from "./shared/components/ColumnView";
import FatalError from "./shared/components/FatalError";
import StarRating from "./shared/components/StarRating";
import Success from "./shared/components/Success";
import ValidationErrors from "./shared/components/ValidationErrors";
import storeDefinition from "./store";

window.Vue = require("vue");
Vue.use(VueRouter);
Vue.use(Vuex);

Vue.filter("fromNow", value => moment(value).fromNow());
Vue.filter("shortDate", value => {
    const date = moment(value);

    return date.year() === moment().year() ? date.format("MMM Do") : date.format("MMM Do YY")
})

Vue.component("star-rating", StarRating);
Vue.component("fatal-error", FatalError);
Vue.component("success", Success);
Vue.component("v-errors", ValidationErrors);
Vue.component("column-view", ColumnView);

const store = new Vuex.Store(storeDefinition);

axios.interceptors.response.use(
    response => response,
    error => {
        if (401 === error.response.status) {
            store.dispatch("logout");
        }

        return Promise.reject(error);
    }
);

const app = new Vue({
    el: "#app",
    router: router(store),
    store,
    components: {
        index: Index
    },
    beforeCreate() {
        console.log('store');
        this.$store.dispatch("loadStoredState");
        this.$store.dispatch("loadUser");
        console.log('store loaded');
    },
});
