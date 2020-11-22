<template>
  <div>
    <fetching-column-view
      :url="'/api/host/bookings/' + $route.params.id"
      :columns="3"
      v-slot:default="{ item }"
    >
      <div class="card-body">
        <div>Booked {{ item.created_at | shortDate }}</div>
        <div>From {{ item.from | shortDate }} to {{ item.to | shortDate }}</div>
        <div>Paid {{ item.price }}$</div>
        <div>Customer {{ item.customer ? item.customer.name : 'Anonymous' }}</div>
      </div>
    </fetching-column-view>
  </div>
</template>