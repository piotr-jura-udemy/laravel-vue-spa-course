<template>
  <div>
    <fetching-column-view
      :url="'/api/host/bookings/' + $route.params.id"
      :columns="2"
      v-slot:default="{ item }"
    >{{ item.created_at }}</fetching-column-view>
  </div>
</template>