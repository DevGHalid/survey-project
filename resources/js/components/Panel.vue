<template>
  <div class="panel">
    <div class="panel-content">
      <div class="card">
        <div class="card-header">
          <span class="card-close" @click="$emit('onClose')">X</span>
        </div>
        <div class="card-body">
          <slot name="default"></slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    document.body.classList.add("modal-open");
  },
  destroyed() {
    document.body.classList.remove("modal-open");
  }
};
</script>


<style lang="scss" scoped>
.panel {
  z-index: 9999;
  position: fixed;
  right: 0;
  top: 0;
  background-color: rgba(0, 0, 0, 0.3);

  width: 100%;

  &-content {
    max-width: 30%;
    margin-left: auto;
  }
}

.panel,
.panel-content,
.card {
  height: 100%;
}

.card {
  position: relative;

  &-close {
    font-size: 20px;
    cursor: pointer;

    &:hover {
      opacity: 0.8;
    }
  }
}
</style>