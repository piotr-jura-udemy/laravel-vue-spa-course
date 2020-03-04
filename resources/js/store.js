import { isLoggedIn, logOut } from "./shared/utils/auth";

export default {
    state: {
        lastSearch: {
            from: null,
            to: null
        },
        basket: {
            items: []
        },
        user: {},
        isLoggedIn: false
    },
    mutations: {
        setLastSearch(state, payload) {
            state.lastSearch = payload;
        },
        addToBasket(state, payload) {
            state.basket.items.push(payload);
        },
        removeFromBasket(state, payload) {
            state.basket.items = state.basket.items.filter(
                item => item.bookable.id !== payload
            );
        },
        setBasket(state, payload) {
            state.basket = payload;
        },
        setUser(state, payload) {
            state.user = payload;
        },
        setLoggedIn(state, payload) {
            state.isLoggedIn = payload;
        }
    },
    actions: {
        setLastSearch(context, payload) {
            context.commit("setLastSearch", payload);
            localStorage.setItem("lastSearch", JSON.stringify(payload));
        },
        loadStoredState(context) {
            const lastSearch = localStorage.getItem("lastSearch");
            if (lastSearch) {
                context.commit("setLastSearch", JSON.parse(lastSearch));
            }

            const basket = localStorage.getItem("basket");
            if (basket) {
                context.commit("setBasket", JSON.parse(basket));
            }

            context.commit("setLoggedIn", isLoggedIn());
        },
        async loadUser({ commit }) {
            if (isLoggedIn()) {
                try {
                    const user = (await axios.get('/user')).data;
                    commit("setUser", user);
                } catch (e) {
                    commit("setUser", {});
                    logOut();
                }
            }
        },
        addToBasket({ commit, state }, payload) {
            // context.state, context.commit
            commit("addToBasket", payload);
            localStorage.setItem("basket", JSON.stringify(state.basket));
        },
        removeFromBasket({ commit, state }, payload) {
            commit("removeFromBasket", payload);
            localStorage.setItem("basket", JSON.stringify(state.basket));
        },
        clearBasket({ commit, state }, payload) {
            commit("setBasket", {
                items: []
            });
            localStorage.setItem("basket", JSON.stringify(state.basket));
        }
    },
    getters: {
        itemsInBasket: state => state.basket.items.length,
        inBasketAlready(state) {
            return function (id) {
                return state.basket.items.reduce(
                    (result, item) => result || item.bookable.id === id,
                    false
                );
            };
        }
    }
};
