<template>
  <div>
    <nav class="navbar bg-white border-bottom navbar-light">
      <router-link class="navbar-brand mr-auto" :to="{name: 'home'}">LaravelBnb</router-link>

      <a class="btn nav-button" href="#" v-if="isLoggedIn">
        <span v-if="username">Hello {{ username }}</span>
        <span v-else>Wait for it...</span>
      </a>
      <a class="btn nav-button" href="#" @click="logout" v-if="isLoggedIn">Logout</a>

      <router-link :to="{name: 'register'}" class="btn nav-button" v-if="!isLoggedIn">Register</router-link>
      <router-link :to="{name: 'login'}" class="btn nav-button" v-if="!isLoggedIn">Sign-in</router-link>

      <router-link class="btn nav-button" :to="{name: 'basket'}">
        Basket
        <span v-if="itemsInBasket" class="badge badge-secondary">{{ itemsInBasket }}</span>
      </router-link>
    </nav>

    <div class="container mt-4 mb-4 pr-4 pl-4">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import { mapState, mapGetters } from "vuex";
import { logOut } from "./shared/utils/auth";

export default {
  data() {
    return {
      lastSearch: this.$store.state.lastSearch
    };
  },
  computed: {
    ...mapState({
      lastSearchComputed: "lastSearch",
      username: state => state.user.name,
      isLoggedIn: "isLoggedIn"
    }),
    ...mapGetters({
      itemsInBasket: "itemsInBasket"
    }),
    somethingElse() {
      return 1 + 2;
    }
  },
  methods: {
    logout() {
      logOut();
      this.$store.commit("setUser", {});
      this.$store.commit("setLoggedIn", false);
    }
  }
};
</script>