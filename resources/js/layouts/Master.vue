<template>
  <div class="main">
    <Header />
    <Navigation />
    <div class="page-content">
      <slot name="default"></slot>
    </div>
  </div>
</template>

<script>
import Header from "./Header";
import Navigation from "./Navigation";

export default {
  components: {
    Header,
    Navigation
  }
};
</script>

<style scoped>
</style>