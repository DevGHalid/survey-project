<template>
  <div class="header d-lg-flex p-0 collapse">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-3 ml-auto"></div>
        <div class="col col-lg order-lg-first">
          <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
            <li class="nav-item" v-for="item in menu" :key="item.title">
              <router-link :to="item.to" active-class="active" aria-current="page" class="nav-link">
                <i :class="item.icon"></i>
                {{ item.title }}
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    menu: [
      {
        title: "Сотрудники",
        to: "/users",
        icon: "fe fe-box"
      },
      {
        title: "Формы",
        to: "/forms",
        icon: "fe fe-box"
      }
    ]
  })
};
</script>

<style scoped>
.nav .nav-link.active {
  color: #17a2b8;
  border-bottom: 1px solid #17a2b8;
}
</style>