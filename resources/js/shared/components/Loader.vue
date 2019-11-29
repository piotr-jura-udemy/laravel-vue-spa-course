<template>
  <div class="loader" v-if="show">
    <div class="d-flex text-center align-items-center justify-content-center w-100">
      <div>
        <i class="fas fa-circle-notch fa-spin fa-4x"></i>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    show: Boolean
  }
};
</script>

<style scoped>
.loader {
  position: absolute;
  background-color: rgba(255, 255, 255, 0.5);
  display: flex;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  z-index: 999;
}
</style>