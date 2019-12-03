<template>
  <div>
    <div class="row">
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-6 form-group">
            <label for="first_names">First names</label>
            <input type="text" class="form-control" name="first_names" />
          </div>
          <div class="col-md-6 form-group">
            <label for="last_name">Last name</label>
            <input type="text" class="form-control" name="last_name" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 form-group">
            <label for="street">Street</label>
            <input type="text" class="form-control" name="street" />
          </div>
          <div class="col-md-6 form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" name="city" />
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 form-group">
            <label for="country">Country</label>
            <input type="text" class="form-control" name="country" />
          </div>
          <div class="col-md-4 form-group">
            <label for="state">State</label>
            <input type="text" class="form-control" name="state" />
          </div>
          <div class="col-md-2 form-group">
            <label for="zip">Zip</label>
            <input type="text" class="form-control" name="zip" />
          </div>
        </div>
        <hr />
        <div class="row">
          <div class="col-md-12 form-group">
            <button type="submit" class="btn btn-lg btn-primary btn-block">Book now!</button>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="d-flex justify-content-between">
          <h6 class="text-uppercase text-secondary font-weight-bolder">Your Cart</h6>
          <h6 class="badge badge-secondary text-uppercase">
            <span v-if="itemsInBasket">Items {{ itemsInBasket }}</span>
            <span v-else>Empty</span>
          </h6>
        </div>

        <transition-group name="fade">
          <div v-for="item in basket" :key="item.bookable.id">
            <div class="pt-2 pb-2 border-top d-flex justify-content-between">
              <span>
                <router-link
                  :to="{name: 'bookable', params: {id: item.bookable.id}}"
                >{{ item.bookable.title }}</router-link>
              </span>
              <span class="font-weight-bold">${{ item.price.total }}</span>
            </div>

            <div class="pt-2 pb-2 d-flex justify-content-between">
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
  </div>
</template>

<script>
import { mapGetters, mapState } from "vuex";

export default {
  computed: {
    ...mapGetters(["itemsInBasket"]),
    ...mapState({
      basket: state => state.basket.items
    })
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