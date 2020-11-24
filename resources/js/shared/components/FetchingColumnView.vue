<template>
  <div>
    <loading-circle v-if="loading"></loading-circle>
    <div v-else>
      <column-view :items="items" :columns="columns" v-slot:default="slotProps">
        <slot v-bind:item="slotProps.item" v-bind:column="slotProps.column"></slot>
      </column-view>
    </div>

    <fatal-error v-if="!url"></fatal-error>
  </div>
</template>

<script>
export default {
  props: {
    url: String,
    columns: Number
  },
  data() {
    return {
      items: null,
      loading: false,
      error: false
    };
  },
  created() {
    this.loading = true;

    const request = axios
      .get(this.url)
      .then(response => {
        this.items = response.data.data;
        this.loading = false;
      })
      .catch(err => {
        this.loading = false;
        this.error = true;
      });
  }
};
</script>