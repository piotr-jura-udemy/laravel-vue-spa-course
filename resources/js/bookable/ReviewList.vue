<template>
  <div class="d-none d-md-block">
    <h6 class="text-uppercase text-secondary font-weight-bolder pt-4">Review List</h6>

    <div v-if="loading">Loading...</div>
    <div v-if="!loading && reviews">
      <div class="border-bottom" v-for="(review, index) in reviews" :key="index">
        <div class="row pt-4">
          <div class="col-md-6 text-muted">{{ review.customer.name }}</div>
          <div class="col-md-6 d-flex justify-content-end">
            <star-rating :value="review.rating" class="fa-lg"></star-rating>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-muted">{{ review.created_at | fromNow }}</div>
        </div>
        <div class="row pt-4 pb-4">
          <div class="col-md-12">{{ review.content }}</div>
        </div>
      </div>
    </div>
    <div v-if="!loading && !reviews" class="text-muted">
      Unable to load reviews at this time
    </div>
  </div>
</template>

<script>
export default {
  props: {
    bookableId: [String, Number]
  },
  data() {
    return {
      loading: false,
      reviews: null
    };
  },
  async created() {
    this.loading = true;

    try {
      this.reviews = (
        await axios.get(`/api/bookables/${this.bookableId}/reviews`)
      ).data.data;
    } catch (error) {}

    this.loading = false;
  }
};
</script>