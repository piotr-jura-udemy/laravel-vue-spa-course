<template>
  <div>
    <fetching-column-view url="/api/my/bookings" :columns="3" v-slot:default="slotProps">
      <trip :trip="slotProps.item"></trip>
    </fetching-column-view>
  </div>
</template>

<script>
import Trip from "./Trip";

export default {
  components: {
    Trip
  }
};
</script>