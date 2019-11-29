export default {
    state: {
        lastSearch: {
            from: null,
            to: null
        },
        basket: {
            items: []
        }
    },
    mutations: {
        setLastSearch(state, payload) {
            state.lastSearch = payload;
        },
        setBasket(state, payload) {
            state.basket = payload;
        },
        addToBasket(state, payload) {
            state.basket.items.push(payload);
        },
        removeFromBasket(state, payload) {
            state.basket.items = state.basket.items.filter(item => item.bookable.id !== payload);
        },
        clearBasket(state) {
            state.basket.items = [];
        }
    },
    actions: {
        setLastSearch({ commit }, payload) {
            commit('setLastSearch', payload);
            localStorage.setItem('lastSearch', JSON.stringify(payload));
        },
        loadStoredState({ commit }) {
            const lastSearch = localStorage.getItem('lastSearch');
            if (lastSearch) {
                commit('setLastSearch', JSON.parse(lastSearch));
            }

            const basket = localStorage.getItem('basket');
            if (basket) {
                commit('setBasket', JSON.parse(basket));
            }
        },
        addToBasket({ commit, state }, payload) {
            commit("addToBasket", payload);
            localStorage.setItem("basket", JSON.stringify(state.basket));
        },
        removeFromBasket({ commit, state }, payload) {
            commit("removeFromBasket", payload);
            localStorage.setItem("basket", JSON.stringify(state.basket));
        },
        clearBasket({ commit, state }) {
            commit("clearBasket");
            localStorage.setItem("basket", JSON.stringify(state.basket));
        }
    },
    getters: {
        itemsInBasket: (state) => state.basket.items.length,
        inBasketAlready(state) {
            return function (id) {
                return state.basket.items.reduce(
                    (result, item) => result || item.bookable.id === id,
                    false
                );
            }
        }
    }
};