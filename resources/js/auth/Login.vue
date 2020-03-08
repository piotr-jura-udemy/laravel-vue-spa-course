<template>
  <div class="d-flex w-50 m-auto align-items-center">
    <div class="card-body">
      <form>
        <div class="form-group">
          <label for="email">E-mail</label>
          <input
            type="text"
            name="email"
            placeholder="Enter your e-mail"
            label="E-mail"
            class="form-control"
            v-model="username"
            :class="[{'is-invalid': errorFor('email')}]"
          />
          <v-errors :errors="errorFor('email')"></v-errors>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input
            type="password"
            name="password"
            placeholder="Enter your password"
            label="Password"
            class="form-control"
            v-model="password"
            :class="[{'is-invalid': errorFor('password')}]"
          />
          <v-errors :errors="errorFor('password')"></v-errors>
        </div>

        <button
          type="submit"
          class="btn btn-primary btn-lg btn-block"
          @click.prevent="login"
          :disabled="loading"
        >Log-in</button>
      </form>
    </div>
  </div>
</template>

<script>
import { logIn } from "./../shared/utils/auth";
import validationErrors from "../shared/mixins/validationErrors";

export default {
  mixins: [validationErrors],
  data() {
    return {
      loading: false,
      username: null,
      password: null
    };
  },
  methods: {
    async login() {
      this.loading = true;

      try {
        // Reset errors first!
        this.errors = null;
        // Get CSRF cookie first
        await axios.get("/airlock/csrf-cookie");
        // Attempt login
        await axios.post("/login", {
          email: this.username,
          password: this.password
        });
        logIn();
        this.$store.dispatch("loadUser");
        this.$router.push({ name: "home" });
      } catch (error) {
        this.errors = error.response.data.errors;
      }

      this.loading = false;
    }
  }
};
</script>