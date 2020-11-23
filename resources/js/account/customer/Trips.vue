<template>
  <div>
    <div v-if="loading">Data is loading...</div>
    <div v-if="!loading && items">
      <div class="row">
        <div
          class="col-sm-6 col-lg-3 d-flex align-items-stretch mb-4"
          v-for="item in items"
          :key="item.id"
        >
          <div class="card w-100">
            <div class="card-body">
              <div class="w-100">
                <small class="font-weight-bold text-muted">{{ item.from }} to {{ item.to }}</small>
              </div>
              <h5>
                <router-link
                  :to="{name: 'bookable', params: {id: item.bookable_id}}"
                >{{ item.bookable_title }}</router-link>
              </h5>
              <div>${{ item.price }}</div>

              <div v-if="!item.rating">
                <router-link :to="{name: 'review', params: {id: item.review_key}}">Leave a review</router-link>
              </div>
              <div v-else>
                <star-rating :value="item.rating" style="padding-top: 5px"></star-rating>
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
      loading: false
    };
  },
  async created() {
    this.loading = true;

    try {
      this.items = (await axios.get("/api/account/customer/trips")).data.data;
    } catch (error) {}

    this.loading = false;
  }
};
</script>