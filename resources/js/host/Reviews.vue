<template>
  <div>
    <fetching-column-view
      :url="'/api/host/reviews/' + $route.params.id"
      :columns="3"
      v-slot:default="{ item }"
    >
      <div class="w-100">
        <div class="card-body">
          <div class="mb-2">
            <star-rating :value="item.rating"></star-rating>
          </div>
          <div>{{ item.content }}</div>
          <div class="text-secondary">{{ item.created_at | shortDate }}</div>
          <div>{{ item.author ? item.author.name : 'Anonymous' }}</div>
        </div>
      </div>
    </fetching-column-view>
  </div>
</template>