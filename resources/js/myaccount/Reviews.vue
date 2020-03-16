<template>
  <div>
    <fetching-column-view url="/api/my/reviews" :columns="1" v-slot:default="{ item }">
      <div class="card w-100">
        <div class="card-body">
          <div>
            <span class="text-uppercase text-secondary font-weight-bolder">Review for</span>
            <router-link :to="{name: 'bookable', params: {id: item.bookable_id}}">
              <span class="font-weight-bolder">{{ item.bookable }}</span>
            </router-link>
          </div>
          <div class="mt-2 mb-2">
            <star-rating :value="item.rating"></star-rating>
          </div>
          <div>{{ item.content }}</div>
          <div class="text-secondary">{{ item.created_at | shortDate }}</div>
        </div>
      </div>
    </fetching-column-view>
  </div>
</template>
