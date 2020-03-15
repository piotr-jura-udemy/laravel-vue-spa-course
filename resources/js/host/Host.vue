<template>
  <div>
    <fetching-column-view :columns="2" url="/api/host/bookables" v-slot:default="{ item }">
      <bookable-list-item :bookable="item"></bookable-list-item>
    </fetching-column-view>
  </div>
</template>

<script>
import BookableListItem from "./BookableListItem";

export default {
  components: {
    BookableListItem
  }
};
</script>