<template>
  <div>
    <div class="d-flex justify-content-end pb-4">
      <router-link class="btn btn-primary btn-lg" :to="{name: 'host-bookable-new'}">Add new</router-link>
    </div>
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