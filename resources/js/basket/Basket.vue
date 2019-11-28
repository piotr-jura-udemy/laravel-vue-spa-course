<template>
  <div class="row">
    <loader :show="loading"></loader>
    <div class="col-md-8">
      <form>
        <div class="row">
          <div class="col form-group">
            <label for>First name</label>
            <input type="text" class="form-control" placeholder="First name" />
          </div>
          <div class="col form-group">
            <label for>Last name</label>
            <input type="text" class="form-control" placeholder="Last name" />
          </div>
        </div>
        <div class="row">
          <div class="col form-group">
            <label for>Address</label>
            <input type="text" class="form-control" placeholder="E-mail" />
          </div>
        </div>
        <div class="row">
          <div class="col form-group">
            <label for>Country</label>
            <input type="text" class="form-control" />
          </div>
          <div class="col form-group">
            <label for>State</label>
            <input type="text" class="form-control" />
          </div>
          <div class="col form-group">
            <label for>Zip</label>
            <input type="text" class="form-control" />
          </div>
        </div>
        <div class="row">
          <div class="col form-group">
            <button class="btn btn-lg btn-primary btn-block" @click.prevent="book">Book now!</button>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-4">
      <div class="d-flex justify-content-between">
        <h6 class="text-uppercase text-secondary font-weight-bolder">Your Cart</h6>
        <h6 class="badge badge-secondary text-uppercase">
          <span v-if="itemsInBasket">Items {{ itemsInBasket }}</span>
          <span v-else>Empty</span>
        </h6>
      </div>

      <transition-group name="fade" tag="div">
        <div v-for="item in basket" :key="item.bookable.id">
          <div class="pt-2 pb-2 border-top d-flex justify-content-between">
            <span>
              <router-link
                :to="{name: 'bookable', params: {id: item.bookable.id}}"
              >{{ item.bookable.title }}</router-link>
            </span>
            <span class="font-weight-bold">${{ item.price.total }}</span>
          </div>
          <div class="d-flex justify-content-between pt-2 pb-2">
            <span>From {{ item.dates.from }}</span>
            <span>To {{ item.dates.to }}</span>
          </div>
          <div class="pt-2 pb-2 text-right">
            <button
              class="btn btn-sm btn-outline-secondary"
              @click="$store.dispatch('removeFromBasket', item.bookable.id)"
            >
              <i class="fas fa-trash-alt"></i>
            </button>
          </div>
        </div>
      </transition-group>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapState } from "vuex";

export default {
  data() {
    return {
      loading: false
    };
  },
  computed: {
    ...mapGetters(["itemsInBasket"]),
    ...mapState({
      basket: state => state.basket.items
    })
  },
  methods: {
    async book() {
      this.loading = true;

      try {
        await Promise.all(
          this.basket.map(async ({ bookable, dates }) => {
            await axios.get(
              `/api/bookables/${bookable.id}/availability?from=${dates.from}&to=${dates.to}`
            );
          })
        );
      } catch (err) {}

      this.loading = false;
    }
  }
};
</script>

<style scoped>
h6.badge {
  font-size: 100%;
}
a {
  color: black;
}
</style>