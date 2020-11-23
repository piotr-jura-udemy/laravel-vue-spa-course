<template>
  <div>
    <div v-if="loading">Data is loading...</div>
    <div v-if="!loading && items">
      <div class="row" v-for="(row, index) in rows" :key="'row' + index">
        <div
          class="col-md-4 d-flex align-items-stretch mb-4"
          v-for="(item, column) in row"
          :key="'row' + row + column"
        >
          <div class="card w-100">
            <div class="card-body">
              <div class="w-100">
                <small class="font-weight-bold text-muted">{{ item.from }} to {{ item.to }}</small>
              </div>
              <h5>
                <router-link
                  :to="{name: 'bookable', params: {id: item.bookable.id}}"
                >{{ item.bookable.title }}</router-link>
              </h5>
              <div>${{ item.price }}</div>

              <div v-if="!item.review">
                <router-link :to="{name: 'review', params: {id: item.review_key}}">Leave a review</router-link>
              </div>
              <div v-else>
                <star-rating :value="item.review.rating" style="padding-top: 5px"></star-rating>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="!loading && !items">
      <fatal-error></fatal-error>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: null,
      loading: false,
      columns: 3
    };
  },
  computed: {
    rows() {
      if (null === this.items) {
        return [];
      }

      let slicesLeft = Math.ceil(this.items.length / this.columns);
      const result = [];

      while (slicesLeft > 0) {
        const sliceFrom = (slicesLeft - 1) * this.columns;
        result.push(this.items.slice(sliceFrom, sliceFrom + this.columns));
        slicesLeft--;
      }

      return result.reverse();
    }
  },
  async created() {
    this.loading = true;

    try {
      this.items = (await axios.get("/api/account/customer/trips")).data;
    } catch (error) {}

    this.loading = false;
  }
};
</script>