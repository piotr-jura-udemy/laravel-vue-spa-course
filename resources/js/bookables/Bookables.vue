<template>
  <div>
    <div v-if="loading">Data is loading...</div>
    <div v-else>
      <div class="row">
        <div
          class="col-md-4 col-lg-3 col-sm-6 d-flex align-items-stretch mb-4"
          v-for="bookable in bookables"
          :key="bookable.id"
        >
          <bookable-list-item v-bind="bookable"></bookable-list-item>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BookableListItem from "./BookableListItem";

export default {
  components: {
    BookableListItem
  },
  data() {
    return {
      bookables: null,
      loading: false
    };
  },
  created() {
    this.loading = true;

    const request = axios.get("/api/bookables").then(response => {
      this.bookables = response.data.data;
      this.loading = false;
    });
  }
};
</script>