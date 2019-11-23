<template>
  <div>
    <div class="form-group">
      <label class="text-muted">Select the star rating (1 is worst - 5 is best)</label>
      <star-rating class="fa-3x" v-model="review.rating"></star-rating>
    </div>
    <div class="form-group">
      <label for="content" class="text-muted">Describe your expirience with</label>
      <textarea name="content" cols="30" rows="10" class="form-control" v-model="review.content"></textarea>
    </div>

    <button class="btn btn-lg btn-primary btn-block">Submit</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      review: {
        rating: 5,
        content: null
      }
    };
  },
  created() {
    // 1. If review already exists (in reviews table by id)
    // 2. Fetch a booking by a review key
    // 3. Store the review
  }
};
</script>