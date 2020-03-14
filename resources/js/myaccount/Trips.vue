<template>
  <div>
    <div v-if="loading" class="fa-7x text-center">
      <i class="fas fa-cog fa-spin"></i>
    </div>
    <div v-else>
      <column-view :items="trips" columns="3" v-slot:default="slotProps">
        <trip :trip="slotProps.item"></trip>
      </column-view>
    </div>
  </div>
</template>

<script>
import Trip from "./Trip";

export default {
  components: {
    Trip
  },
  data() {
    return {
      trips: null,
      loading: false,
      error: false
    };
  },
  created() {
    this.loading = true;

    const request = axios
      .get("/api/my/bookings")
      .then(response => {
        this.trips = response.data.data;
        this.loading = false;
      })
      .catch(err => {
        this.loading = false;
        this.error = true;
      });
  }
};
</script>