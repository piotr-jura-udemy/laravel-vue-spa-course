<template>
  <div class="card w-100">
    <div class="card-body">
      <div class="w-100">
        <small class="font-weight-bold text-muted">{{ trip.from | shortDate }} to {{ trip.to | shortDate }}</small>
      </div>
      <h5>
        <router-link
          :to="{name: 'bookable', params: {id: trip.bookable.bookable_id}}"
        >{{ trip.bookable.title }}</router-link>
      </h5>
      <div>${{ trip.price }}</div>

      <div v-if="trip.review_key">
        <router-link :to="{name: 'review', params: {id: trip.review_key}}">Leave a review</router-link>
      </div>
      <div v-else>
        <star-rating :value="trip.rating" style="padding-top: 5px"></star-rating>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    trip: Object
  }
};
</script>