<template>
  <div class="d-flex w-50 m-auto align-items-center">
    <div class="card card-body">
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
          />
        </div>

        <button
          type="submit"
          class="btn btn-danger btn-lg btn-block"
          @click.prevent="resetPassword"
        >Reset password</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: null
    };
  },
  methods: {
    async resetPassword() {
      try {
        await axios.post("/password/email", { email: this.email });
      } catch (error) {
        console.log(error);
      }
    }
  }
};
</script>