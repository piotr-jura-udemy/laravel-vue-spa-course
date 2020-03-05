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
          />
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
          />
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

export default {
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
      } catch (err) {
        this.status = (err.response && err.response.status) || 500;
      }

      this.loading = false;
    }
  }
};
</script>