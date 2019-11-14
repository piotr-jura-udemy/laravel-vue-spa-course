<template>
  <div class="row">
    <div
      :class="[{'col-md-4': loading || !alreadyReviewed }, {'d-none': !loading && alreadyReviewed}]"
    >
      <div class="card">
        <div class="card-body">
          <list-loader v-if="loading" class="w-100">Loading...</list-loader>
          <div v-if="!loading && !alreadyReviewed">
            Stayed at
            <router-link
              :to="{name: 'bookable', params: { id: booking.bookable_id }}"
            >{{ booking.bookable.title }}</router-link>
            <p>From {{ booking.from }} to {{ booking.to }}</p>
          </div>
        </div>
      </div>
    </div>
    <div
      :class="[{'col-md-8': loading || !alreadyReviewed }, {'col-md-12': !loading && alreadyReviewed}]"
    >
      <!-- <div v-if="loading">Loading...</div> -->
      <list-loader v-if="loading" primary-color="#fff" secondary-color="#f0f0f0"></list-loader>
      <div v-else>
        <div v-if="alreadyReviewed">You've already left a review, or the review link is invalid!</div>
        <div v-else>
          <label for="content">Describe your expierience</label>
          <textarea class="form-control mb-4" v-model="content" name="content"></textarea>
          <button @click="submit" class="btn btn-primary btn-lg btn-block">Send!</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { ListLoader } from "vue-content-loader";

export default {
  components: {
    ListLoader
  },
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
