<template>
  <div class="card-body">
    <loading-circle v-if="loading"></loading-circle>
    <form v-else>
      <div class="form-group">
        <label for="title">Name</label>
        <input
          type="text"
          name="title"
          placeholder="Name of the object"
          class="form-control"
          v-model="bookable.title"
        />
      </div>

      <div class="form-group">
        <label for="name">Description</label>
        <textarea
          name="description"
          placeholder="Description of the object"
          rows="5"
          class="form-control"
          v-model="bookable.description"
        />
      </div>

      <div class="form-group">
        <label for="name">Daily price in $</label>
        <input
          type="text"
          name="price"
          placeholder="Price for a day in $"
          class="form-control"
          v-model="bookable.price"
        />
      </div>

      <button
        type="submit"
        class="btn btn-primary btn-lg btn-block"
        :disabled="saving"
        @click.prevent="save"
      >Save</button>
    </form>
  </div>
</template>

<script>
import validationErrors from "../shared/mixins/validationErrors";
export default {
  mixins: [validationErrors],
  data() {
    return {
      bookable: null,
      loading: false,
      saving: false
    };
  },
  async created() {
    if (undefined == this.$route.params.id) {
      this.bookable = {
        title: null,
        description: null,
        price: null
      };
      return;
    }

    this.loading = true;

    try {
      this.bookable = (
        await axios.get("/api/host/bookables/" + this.$route.params.id)
      ).data.data;
    } catch (error) {}

    this.loading = false;
  },
  methods: {
    async save() {
      this.saving = true;

      try {
        if (undefined == this.$route.params.id) {
          this.bookable = (
            await axios.post("/api/host/bookables", {
              ...this.bookable
            })
          ).data.data;
          this.saving = false;

          this.$router.push({
            name: "host-bookable",
            params: { id: this.bookable.id, page: "settings" }
          });
        } else {
          this.bookable = (
            await axios.put("/api/host/bookables/" + this.$route.params.id, {
              ...this.bookable
            })
          ).response.data;
        }
      } catch (error) {
        this.errors = error.response && error.response.data.errors;
      }

      this.saving = false;
    }
  }
};
</script>