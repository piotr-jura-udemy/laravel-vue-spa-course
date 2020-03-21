<template>
  <div class="d-flex w-50 m-auto align-items-center">
    <div class="card card-body" v-if="!success">
      <form>
        <div class="form-group">
          <label for="email">E-mail</label>
          <input
            type="text"
            name="email"
            placeholder="Enter your e-mail"
            label="E-mail"
            class="form-control"
            v-model="user.email"
            :class="[{'is-invalid': errorFor('password')}]"
          />
          <v-errors :errors="errorFor('email')"></v-errors>
        </div>

        <div class="form-group">
          <label for="password">New password</label>
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
          <label for="password_confirmation">Re-type new password</label>
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
          class="btn btn-danger btn-lg btn-block"
          @click.prevent="resetPassword"
          :disabled="loading"
        >Reset password</button>
      </form>
    </div>
    <success v-if="success">
      Password updated, you can now login using new credentials
      <router-link :to="{name: 'login'}" class="font-weight-bold">here</router-link>.
    </success>
  </div>
</template>

<script>
import validationErrors from "./../shared/mixins/validationErrors";

export default {
  mixins: [validationErrors],
  data() {
    return {
      user: {
        email: null,
        password: null,
        password_confirmation: null
      },
      loading: false,
      success: false
    };
  },
  methods: {
    async resetPassword() {
      this.loading = true;

      try {
        this.errors = null;
        const response = await axios.post("/password/reset", {
          ...this.user,
          token: this.$route.params.token
        });
        this.success = true;
      } catch (error) {
        this.errors = error.response && error.response.data.errors;
      }

      this.loading = false;
    }
  }
};
</script>