<template>
  <div class="header py-4">
    <div class="container">
      <div class="d-flex">
        <a class="header-brand" href="/">Опросный лист</a>
        <div class="d-flex order-lg-2 ml-auto">
          <div class="nav-item">
            <a class="nav-link d-none d-md-flex"></a>
            <a
              href="javascript:void(0)"
              class="btn btn-sm btn-outline-cyan"
              target="_blank"
            >Добавить сотрудника</a>
          </div>
          <div class="dropdown d-flex">
            <a class="nav-link">
              <i class="fe fe-bell"></i>
              <span class="nav-unread"></span>
            </a>
          </div>
          <div class="dropdown">
            <a class="nav-link pr-0 leading-none" @click="isShowMenu = !isShowMenu">
              <span class="avatar"></span>
              <span class="ml-2 d-none d-lg-block">
                <span class="text-default">{{ auth.username }}</span>
                <small class="text-muted d-block mt-1">Administrator</small>
              </span>
            </a>
            <div
              class="header-dropdown-menu dropdown-menu dropdown-menu-right dropdown-menu-arrow"
              :class="{'show': isShowMenu}"
            >
              <a class="dropdown-item">
                <i class="fe fe-user dropdown-icon"></i> Профиль
              </a>
              <a class="dropdown-item">
                <i class="fe fe-settings dropdown-icon"></i> Настройки
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" @click="handleLogout">
                <i class="fe fe-log-out dropdown-icon"></i> Выйти
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";

export default {
  data: () => ({
    isShowMenu: false
  }),
  computed: {
    ...mapState(["auth"])
  },
  methods: {
    ...mapActions(["logout"]),

    handleLogout() {
      this.logout().then(response => this.$router.push("/login"));
    }
  }
};
</script>

<style lang="scss" scoped>
.header-dropdown-menu {
  position: absolute;
  will-change: transform;
  top: 0px;
  left: 0px;
  transform: translate3d(-56px, 32px, 0px);

  .dropdown-item {
    cursor: pointer;
  }
}
</style>