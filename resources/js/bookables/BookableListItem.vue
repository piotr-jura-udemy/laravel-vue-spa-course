<template>
  <div>
    <h1>{{ itemTitle }}</h1>
    <p>{{ itemContent }}</p>
  </div>
</template>

<script>
export default {
  props: { itemTitle: String, itemContent: String, price: Number },
  mounted() {
    console.log(this.itemTitle);
    // Uncomment to see why modifying prop is a bad idea!
    // setTimeout(() => {
    //   this.itemTitle = "New title";
    // }, 1500);
  }
};
</script>