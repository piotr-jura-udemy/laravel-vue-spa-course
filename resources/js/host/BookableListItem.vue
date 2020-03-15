<template>
  <div class="card card-body">
    <h5>
      <router-link :to="{name: 'host-bookable', params: {id: bookable.id}}">{{ bookable.title }}</router-link>
    </h5>
    <div>Since {{ bookable.created_at | shortDate }}</div>
    <div>
      <router-link :to="{name: 'bookable', params: {id: bookable.id}}">Preview offer</router-link>
    </div>
  </div>
</template>

<script>
export default {
  props: { bookable: Object }
};
</script>