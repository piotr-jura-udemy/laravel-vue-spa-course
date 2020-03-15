<template>
  <div>
    <loading-circle v-if="loading"></loading-circle>
    <column-view :items="bookables" columns="3" v-else>
      <template v-slot:default="slotProps">
        <bookable-list-item v-bind="slotProps.item"></bookable-list-item>
      </template>
    </column-view>

    <fatal-error v-if="error">Shit...</fatal-error>
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
      loading: false,
      error: false
    };
  },
  created() {
    this.loading = true;

    const request = axios
      .get("/api/bookables")
      .then(response => {
        this.bookables = response.data.data;
        this.loading = false;
      })
      .catch(err => {
        this.loading = false;
        this.error = true;
      });
  }
};
</script>