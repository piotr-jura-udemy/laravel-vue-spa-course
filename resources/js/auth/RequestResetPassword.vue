<template>
  <div class="d-flex w-50 m-auto align-items-center">
    <div class="card card-body" v-if="!success">
      <form>
        <div class="form-group">
          <!-- <label for="email">E-mail</label> -->
          <input
            type="text"
            name="email"
            placeholder="Enter your e-mail"
            label="E-mail"
            class="form-control"
            v-model="email"
            :class="[{'is-invalid': errorFor('email')}]"
          />
          <v-errors :errors="errorFor('email')"></v-errors>
        </div>

        <button
          type="submit"
          class="btn btn-danger btn-lg btn-block"
          @click.prevent="resetPassword"
          :disabled="loading"
        >Reset password</button>
      </form>
    </div>
    <success v-if="success">Cool, we've sent you an e-mail at {{email}} with a password reset link.</success>
  </div>
</template>

<script>
import validationErrors from "./../shared/mixins/validationErrors";

export default {
  mixins: [validationErrors],
  data() {
    return {
      loading: false,
      email: null,
      success: false
    };
  },
  methods: {
    async resetPassword() {
      try {
        this.loading = true;
        this.errors = null;
        await axios.get("/airlock/csrf-cookie");
        this.success =
          200 ==
          (await axios.post("/password/email", { email: this.email })).status;
      } catch (error) {
        this.errors = error.response && error.response.data.errors;
      }

      this.loading = false;
    }
  }
};
</script>