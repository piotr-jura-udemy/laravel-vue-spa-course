<template>
  <div>
    <nav class="navbar navbar-expand-lg bg-white sticky-top border-bottom navbar-light">
      <router-link class="navbar-brand mr-auto" :to="{name: 'home'}">LaravelBnb</router-link>

      <ul class="navbar-nav">
        <li class="nav-item" v-if="isLoggedIn">
          <router-link :to="{name: 'host'}" class="nav-link">Host</router-link>
        </li>

        <li class="nav-item">
          <router-link class="nav-link" :to="{name: 'basket'}">
            Basket
            <span v-if="itemsInBasket" class="badge badge-secondary">{{ itemsInBasket }}</span>
          </router-link>
        </li>

        <li class="nav-item" v-if="isLoggedIn">
          <router-link :to="{name: 'trips'}" class="nav-link">Trips</router-link>
        </li>

        <li class="nav-item dropdown" v-if="isLoggedIn">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="navbarDropdown"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >Account</a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <router-link :to="{name: 'reviews'}" class="dropdown-item">Reviews</router-link>

            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="#" @click="logout">Logout</a>
          </div>
        </li>

        <li class="nav-item" v-if="!isLoggedIn">
          <router-link :to="{name: 'register'}" class="nav-link">Register</router-link>
        </li>
        <li class="nav-item" v-if="!isLoggedIn">
          <router-link :to="{name: 'login'}" class="nav-link">Sign-in</router-link>
        </li>
      </ul>
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
      try {
        const response = axios.post("/logout");
        logOut();
        this.$store.commit("setUser", {});
        this.$store.commit("setLoggedIn", false);
      } catch (error) {
        alert("Sth went wrong");
      }
    }
  }
};
</script>