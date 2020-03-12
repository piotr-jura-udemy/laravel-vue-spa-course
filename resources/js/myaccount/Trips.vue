<template>
  <div>
    <column-view :items="['Hey', 'Hi', 'Yo', 'Hey', 'Hi', 'Yo']" columns="3">
      <template v-slot:default="slotProps">Hello {{ slotProps.item }}</template>
    </column-view>
  </div>
</template>