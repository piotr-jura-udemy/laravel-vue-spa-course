<template>
  <div class="d-flex w-75 m-auto align-items-center">
    <div class="card-body">
      <form>
        <div class="form-group">
          <label for="name">Name</label>
          <input
            type="text"
            name="name"
            placeholder="Your full name"
            class="form-control"
            v-model="user.name"
            :class="[{'is-invalid': errorFor('name')}]"
          />
          <v-errors :errors="errorFor('name')"></v-errors>
        </div>

        <div class="form-group">
          <label for="email">E-mail (will be your ursername)</label>
          <input
            type="text"
            name="email"
            placeholder="Enter your e-mail"
            class="form-control"
            v-model="user.email"
            :class="[{'is-invalid': errorFor('email')}]"
          />
          <v-errors :errors="errorFor('email')"></v-errors>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input
            type="password"
            name="password"
            placeholder="Your your password"
            class="form-control"
            v-model="user.password"
            :class="[{'is-invalid': errorFor('password')}]"
          />
          <v-errors :errors="errorFor('password')"></v-errors>
        </div>

        <div class="form-group">
          <label for="password_confirmation">Re-type password</label>
          <input
            type="password"
            name="password_confirmation"
            placeholder="Re-type your password"
            class="form-control"
            v-model="user.password_confirmation"
            :class="[{'is-invalid': errorFor('password_confirmation')}]"
          />
          <v-errors :errors="errorFor('password_confirmation')"></v-errors>
        </div>

        <button
          type="submit"
          class="btn btn-primary btn-lg btn-block"
          @click.prevent="register"
          :disabled="false"
        >Register</button>
      </form>
    </div>
  </div>
</template>

<script>
import validationErrors from "./../shared/mixins/validationErrors";
import { logIn } from "../shared/utils/auth";

export default {
  mixins: [validationErrors],
  data() {
    return {
      user: {
        email: null,
        password: null,
        password_confirmation: null,
        name: null
      }
    };
  },
  methods: {
    async register() {
      try {
        const response = await axios.post("/register", this.user);

        if (201 == response.status) {
          logIn();
          this.$store.dispatch("loadUser");
          this.$router.push({ name: "home" });
        }
      } catch (error) {
        this.errors = error.response.data.errors;
      }
    }
  }
};
</script>