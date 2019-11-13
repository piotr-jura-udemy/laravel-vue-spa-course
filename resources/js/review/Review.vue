<template>
  <div>
    <div v-if="loading">Loading...</div>
    <div v-else>
      <div v-if="alreadyReviewed">You've already left a review, or the review link is invalid!</div>
      <div v-else>
        <h6
          class="text-uppercase text-secondary font-weight-bolder pt-4"
        >You are reviewing {{ booking.bookable.title }}, you've stayed there from {{ booking.from }} to {{ booking.to }}</h6>
        <label for="content">Leave a review</label>
        <textarea class="form-control mb-4" v-model="content" name="content"></textarea>
        <button @click="submit" class="btn btn-primary btn-lg btn-block">Send!</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      review: null,
      content: null,
      booking: null,
      loading: false
    };
  },
  created() {
    this.loading = true;
    axios
      .get(`/api/reviews/${this.$route.params.id}`)
      .then(response => (this.review = response.data))
      .catch(error => {
        if (404 === error.response.status) {
          this.review = false;
          return axios.get(`/api/booking-by-reviews/${this.$route.params.id}`);
        }
      })
      .then(response => {
        this.booking = response.data;
      })
      .catch(error => {})
      .then(() => (this.loading = false));
  },
  methods: {
    submit() {
      this.loading = true;
      axios
        .post(`/api/reviews`, {
          content: this.content,
          id: this.$route.params.id,
          rating: 5,
          bookable_id: this.booking.bookable_id,
          booking_id: this.booking.id
        })
        .then(response => {
          //
        })
        .catch(error => {
          //
        })
        .then(() => (this.loading = false));
    }
  },
  computed: {
    alreadyReviewed() {
      return this.review || this.booking === null;
    }
  }
};
</script>