<template>
  <div>
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a
          class="nav-link"
          :class="{active: active == 'bookings'}"
          href="#"
          @click.prevent="active = 'bookings'"
        >Bookings</a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link"
          :class="{active: active == 'reviews'}"
          href="#"
          @click.prevent="active = 'reviews'"
        >Reviews</a>
      </li>
      <li class="nav-item">
        <a
          class="nav-link"
          :class="{active: active == 'settings'}"
          href="#"
          @click.prevent="active = 'settings'"
        >Settings</a>
      </li>
    </ul>
    <div class="pt-4 pr-2 pl-2">
      <bookings v-if="active=='bookings'"></bookings>
      <reviews v-if="active=='reviews'"></reviews>
      <settings v-if="active=='settings'"></settings>
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
  data() {
    return {
      active: "bookings"
    };
  },
  methods: {
    async load() {}
  }
};
</script>

