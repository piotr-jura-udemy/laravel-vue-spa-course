<template>
  <div>
    <bookable-list-item
      :item-title="bookable1.title"
      :item-content="bookable1.content"
      :price="1000"
    ></bookable-list-item>
    <bookable-list-item
      :item-title="bookable2.title"
      :item-content="bookable2.content"
      :price="1500"
    ></bookable-list-item>
  </div>
</template>

<script>
import BookableListItem from "./BookableListItem";

export default {
  components: {
    BookableListItem
  },
  data() {
    return {
      bookable1: {
        title: "Cheap Villa !!!",
        content: "A very cheap villa"
      },
      bookable2: {
        title: "Cheap Villa 2",
        content: "A very cheap villa 2"
      }
    };
  },
  // beforeCreate() {
  //   console.log("before create");
  // },
  created() {
    console.log("created");
    console.log(this.bookable1);
    console.log(this.bookable2);

    setTimeout(() => {
      this.bookable1.title = "Expensive Villa";
      this.bookable2.title = "Very Expensive Villa";
    }, 5000);
  }
  // beforeMount() {
  //   console.log("before mount");
  // },
  // mounted() {
  //   console.log("mounted");
  // },
  // beforeDestroy() {
  //   console.log("before destroy");
  // },
  // destroyed() {
  //   console.log("destroyed");
  // }
};
</script>