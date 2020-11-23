<template>
  <div>
    <div v-if="loading">Data is loading...</div>
    <div v-if="!loading && bookables">
      <div class="row">
        <div
          class="col-lg-3 col-sm-6 d-flex align-items-stretch mb-4"
          v-for="bookable in bookables"
          :key="bookable.id"
        >
          <bookable-list-item v-bind="bookable"></bookable-list-item>
        </div>
      </div>
    </div>

    <div v-if="!loading && !bookables">
      <fatal-error></fatal-error>
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
  async created() {
    this.loading = true;

    try {
      this.bookables = (await axios.get("/api/bookables")).data.data;
    } catch (error) {}

    this.loading = false;
  }
};
</script>