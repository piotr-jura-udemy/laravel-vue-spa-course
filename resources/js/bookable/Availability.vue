<template>
  <div>
    <h6 class="text-uppercase text-secondary font-weight-bolder">Check Availability</h6>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="from">From</label>
        <input
          type="text"
          name="from"
          class="form-control form-control-sm"
          placeholder="Start date"
        />
      </div>

      <div class="form-group col-md-6">
        <label for="to">To</label>
        <input type="text" name="to" class="form-control form-control-sm" placeholder="End date" />
      </div>
    </div>

    <button class="btn btn-secondary btn-block">Check!</button>
  </div>
</template>

<style scoped>
label {
  font-size: 0.7rem;
  text-transform: uppercase;
  color: gray;
  font-weight: bolder;
}
</style>