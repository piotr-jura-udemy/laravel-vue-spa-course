<template>
  <div class="text-center text-muted">
    <i class="fas fa-bomb error"></i>
    <h1 class="mt-4"><slot name="header">We've encountered a problem</slot></h1>
    <h2><slot name="subheader">Unfortunately we cannot proceed</slot></h2>
    <div><slot name="content"></slot></div>
  </div>
</template>

<style scoped>
.error {
  font-size: 5rem;
}
</style>