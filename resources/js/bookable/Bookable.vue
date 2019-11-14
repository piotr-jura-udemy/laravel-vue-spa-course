<template>
  <div class="row">
    <div class="col-md-8 pb-4">
      <div class="card">
        <div class="card-body">
          <list-loader v-if="loading">Loading...</list-loader>
          <div v-else>
            <h2>{{ bookable.title }}</h2>
            <hr />
            <article>{{ bookable.description }}</article>
          </div>
        </div>
      </div>

      <review-list></review-list>
    </div>
    <div class="col-md-4 pb-4">
      <list-loader v-if="loading" primary-color="#fff" secondary-color="#f0f0f0">Loading...</list-loader>
      <div v-else>
        <availability></availability>
      </div>
    </div>
  </div>
</template>

<script>
import Availability from "./Availability";
import ReviewList from "./ReviewList";

import { ListLoader } from "vue-content-loader";

export default {
  components: {
    Availability,
    ReviewList,
    ListLoader
  },
  data() {
    return {
      bookable: null,
      loading: false
    };
  },
  created() {
    this.loading = true;
    axios.get(`/api/bookables/${this.$route.params.id}`).then(response => {
      this.bookable = response.data.data;
      this.loading = false;
    });
  }
};
</script>