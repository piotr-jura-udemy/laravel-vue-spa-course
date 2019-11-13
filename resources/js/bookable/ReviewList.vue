<template>
  <div style="padding: 1.25rem">
    <h6 class="text-uppercase text-secondary font-weight-bolder pt-4">
      Reviews
      <span v-if="reviews">({{ reviews.length }})</span>
    </h6>

    <div v-if="loading">Loading reviews...</div>
    <div v-else>
      <div class="border-bottom d-none d-md-block" v-for="review in reviews" :key="review.id">
        <div class="row pt-4">
          <div class="col-6">
            <div>Piotr Jura</div>
          </div>
          <div class="col-6 d-flex justify-content-end">
            {{ review.rating }}
            <div class="d-flex">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <!---->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-small text-muted">Added {{ review.created_at }}</div>
        </div>
        <div class="row pt-4 pb-4">
          <div class="col-md-12">{{ review.content }}</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loading: false,
      reviews: null
    };
  },
  created() {
    axios
      .get(`/api/bookables/${this.$route.params.id}/reviews`)
      .then(response => (this.reviews = response.data))
      .then(() => (this.loading = false));
  }
};
</script>