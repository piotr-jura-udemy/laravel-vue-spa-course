<template>
  <div>
    <transition name="fade">
      <success v-if="bookingSuccess">Everything booked successfully!</success>
    </transition>

    <div class="row" v-if="!bookingSuccess">
      <loader :show="loading"></loader>
      <div class="col-md-8">
        <form>
          <div class="row">
            <div class="col form-group">
              <label for>First name</label>
              <input
                type="text"
                class="form-control"
                placeholder="First name"
                v-model="customer.first_names"
                name="first_names"
                :class="[{'is-invalid': errorFor('customer.first_names')}]"
              />
              <v-errors :errors="errorFor('customer.first_names')"></v-errors>
            </div>
            <div class="col form-group">
              <label for>Surname</label>
              <input
                type="text"
                class="form-control"
                placeholder="Last name"
                v-model="customer.surname"
                name="surname"
                :class="[{'is-invalid': errorFor('customer.surname')}]"
              />
              <v-errors :errors="errorFor('customer.surname')"></v-errors>
            </div>
          </div>
          <div class="row">
            <div class="col form-group">
              <label for>Address</label>
              <input
                type="text"
                class="form-control"
                placeholder="E-mail"
                name="address"
                v-model="customer.address"
                :class="[{'is-invalid': errorFor('customer.address')}]"
              />
              <v-errors :errors="errorFor('customer.address')"></v-errors>
            </div>
            <div class="col form-group">
              <label for>E-mail</label>
              <input
                type="text"
                class="form-control"
                placeholder="E-mail"
                name="email"
                v-model="customer.email"
                :class="[{'is-invalid': errorFor('customer.email')}]"
              />
              <v-errors :errors="errorFor('customer.email')"></v-errors>
            </div>
          </div>
          <div class="row">
            <div class="col form-group">
              <label for>Country</label>
              <input
                type="text"
                class="form-control"
                v-model="customer.country"
                name="country"
                :class="[{'is-invalid': errorFor('customer.country')}]"
              />
              <v-errors :errors="errorFor('customer.country')"></v-errors>
            </div>
            <div class="col form-group">
              <label for>State</label>
              <input
                type="text"
                class="form-control"
                name="state"
                v-model="customer.state"
                :class="[{'is-invalid': errorFor('customer.state')}]"
              />
              <v-errors :errors="errorFor('customer.state')"></v-errors>
            </div>
            <div class="col form-group">
              <label for>Zip</label>
              <input
                type="text"
                class="form-control"
                v-model="customer.zip"
                name="zip"
                :class="[{'is-invalid': errorFor('customer.zip')}]"
              />
              <v-errors :errors="errorFor('customer.zip')"></v-errors>
            </div>
          </div>
          <div class="row">
            <div class="col form-group">
              <button
                type="submit"
                class="btn btn-lg btn-primary btn-block"
                :disabled="0 === itemsInBasket"
                @click.prevent="book"
              >Book now!</button>
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
            <div
              class="pt-2 pb-2 text-danger"
              v-if="cannotBook.includes(item.bookable.id)"
            >This item cannot be booked right now. Please remove it from the basket and try again.</div>
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
  </div>
</template>

<script>
import { mapGetters, mapState } from "vuex";
import validationErrors from "./../shared/mixins/validationErrors";
import { is422 } from "../shared/utils/response";

export default {
  mixins: [validationErrors],
  data() {
    return {
      loading: false,
      customer: {
        first_names: null,
        surname: null,
        address: null,
        email: null,
        country: null,
        state: null,
        zip: null
      },
      cannotBook: [],
      didBook: false
    };
  },
  computed: {
    ...mapGetters(["itemsInBasket"]),
    ...mapState({
      basket: state => state.basket.items
    }),
    bookingSuccess() {
      return (
        this.errors === null &&
        0 === this.cannotBook.length &&
        0 === this.itemsInBasket &&
        this.didBook
      );
    }
  },
  methods: {
    async book() {
      this.loading = true;
      this.errors = null;
      this.cannotBook = [];

      try {
        await Promise.all(
          this.basket.map(async ({ bookable, dates }) => {
            try {
              await axios.get(
                `/api/bookables/${bookable.id}/availability?from=${
                  dates.from
                }&to=${dates.to}`
              );
            } catch (err) {
              this.cannotBook.push(bookable.id);
              return;
            }

            try {
              await axios.post(`/api/bookings`, {
                bookable,
                dates,
                customer: this.customer
              });
            } catch (err) {
              if (is422(err)) {
                this.errors = Object.assign(
                  this.errors || {},
                  err.response.data.errors || {}
                );
              }

              if (!is422(err) || !err.response.data.errors) {
                this.cannotBook.push(bookable.id);
              }
            }
          })
        );

        if (0 === this.cannotBook.length && null === this.errors) {
          console.log("Clearing basket...");
          this.$store.dispatch("clearBasket");
        }
      } catch (err) {}

      this.loading = false;
      this.didBook = true;
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