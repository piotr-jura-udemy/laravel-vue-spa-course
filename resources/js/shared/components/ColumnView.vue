<template>
  <div>
    <div class="row mb-4" v-for="row in rows" :key="'row' + row">
      <div
        class="col d-flex align-items-stretch"
        v-for="(item, column) in itemsInRow(row)"
        :key="'row' + row + column"
      >
        <slot v-bind:item="item" v-bind:column="column"></slot>
      </div>

      <div class="col" v-for="p in placeholdersInRow(row)" :key="'placeholder' + row + p"></div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["columns", "items"],
  computed: {
    rows() {
      return this.items === null
        ? 0
        : Math.ceil(this.items.length / this.columns);
    }
  },
  methods: {
    itemsInRow(row) {
      return this.items.slice((row - 1) * this.columns, row * this.columns);
    },
    placeholdersInRow(row) {
      return this.columns - this.itemsInRow(row).length;
    }
  }
};
</script>