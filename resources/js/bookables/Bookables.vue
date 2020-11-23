<template>
  <div>
    <div v-if="loading">Data is loading...</div>
    <div v-else>
      <div class="row" v-for="(row, index) in rows" :key="'row' + index">
        <div
          class="col-md-4 d-flex align-items-stretch mb-4"
          v-for="(bookable, column) in row"
          :key="'row' + row + column"
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
      loading: false,
      columns: 3
    };
  },
  computed: {
    rows() {
      if (null === this.bookables) {
        return [];
      }

      let slicesLeft = Math.ceil(this.bookables.length / this.columns);
      const result = [];

      while (slicesLeft > 0) {
        const sliceFrom = (slicesLeft - 1) * this.columns;
        result.push(this.bookables.slice(sliceFrom, sliceFrom + this.columns));
        slicesLeft--;
      }

      return result.reverse();
    }
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