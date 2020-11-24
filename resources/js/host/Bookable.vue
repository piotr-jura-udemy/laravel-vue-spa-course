<template>
  <div>
    <ul class="nav nav-pills">
      <li class="nav-item">
        <router-link class="nav-link" :class="css('bookings')" :to="link('bookings')">Bookings</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" :class="css('reviews')" :to="link('reviews')">Reviews</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link" :class="css('settings')" :to="link('settings')">Settings</router-link>
      </li>
    </ul>

    <div class="card-body">
      <bookings v-if="$route.params.page=='bookings'"></bookings>
      <reviews v-if="$route.params.page=='reviews'"></reviews>
      <settings v-if="$route.params.page=='settings' || !$route.params.page"></settings>
    </div>
  </div>
</template>

<script>
import Bookings from "./Bookings";
import Reviews from "./Reviews";
import Settings from "./Settings";

export default {
  components: {
    Bookings,
    Reviews,
    Settings
  },
  methods: {
    link(toPage) {
      if (!this.$route.params.id) {
        return {};
      }

      return {
        name: "host-bookable",
        params: { id: this.$route.params.id, page: toPage }
      };
    },
    css(page) {
      const active = this.$route.params.page;

      if ("settings" == page && (active == page || !active)) {
        return {
          active: "settings"
        };
      }

      return {
        active: active == page,
        disabled: !active
      };
    },
    show(page) {}
  }
};
</script>

