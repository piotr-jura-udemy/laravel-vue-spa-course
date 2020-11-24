<template>
  <div>
    <div v-if="items && items.length">
      <div class="row" v-for="row in rows" :key="'row' + row">
        <div
          class="col-md d-flex align-items-stretch mb-4"
          v-for="(item, column) in itemsInRow(row)"
          :key="'row' + row + column"
        >
          <slot v-bind:item="item" v-bind:column="column"></slot>
        </div>

        <div class="col" v-for="p in placeholdersInRow(row)" :key="'placeholder' + row + p"></div>
      </div>
    </div>
    <div v-else>
      <slot name="empty">
        <div class="text-center text-black-50">
          <i class="fas fa-search" style="font-size: 7rem"></i>
          <h3 class="mt-4">Nothing here yet</h3>
        </div>
      </slot>
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