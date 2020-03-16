<template>
  <div>
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <router-link
          class="nav-link"
          :class="{active: $route.params.page == 'bookings', disabled: !$route.params.page}"
          :to="{name: 'host-bookable', params: {id: $route.params.id, page: 'bookings'}}"
        >Bookings</router-link>
      </li>
      <li class="nav-item">
        <router-link
          class="nav-link"
          :class="{active: $route.params.page == 'reviews', disabled: !$route.params.page}"
          :to="{name: 'host-bookable', params: {id: $route.params.id, page: 'reviews'}}"
        >Reviews</router-link>
      </li>
      <li class="nav-item">
        <router-link
          class="nav-link"
          :class="{active: $route.params.page == 'settings' || !$route.params.page}"
          :to="{name: 'host-bookable', params: {id: $route.params.id, page: 'settings'}}"
        >Settings</router-link>
      </li>
    </ul>
    <div class="pt-4 pr-2 pl-2 card card-body border-top-0 rounded-0">
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
  }
};
</script>

