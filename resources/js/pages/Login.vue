<template>
  <div class="container">
    <form class="card card-form-login" @submit.prevent="handleSubmit">
      <div class="card-body">
        <div class="card-title">Войти аккаунт</div>
        <div class="form-group">
          <label class="form-label">Введите почту</label>
          <input type="email" class="form-control" placeholder="Почта" v-model="email" />
        </div>
        <div class="form-group">
          <label class="form-label">Введите пароль</label>
          <input type="password" class="form-control" placeholder="Пароль" v-model="password" />
        </div>
        <div class="form-footer">
          <button class="btn btn-block btn-cyan" :class="{'btn-loading': isLoading}">Войти</button>
          <small v-if="isError" class="text-danger d-block mt-4">{{ error.message }}</small>
        </div>
      </div>
    </form>
  </div>
</template>
<script>
import { mapActions, mapGetters } from "vuex";

export default {
  data: () => ({
    email: "",
    password: "",
    error: {}
  }),

  computed: {
    ...mapGetters(["authStatus"]),

    isLoading() {
      return this.authStatus === "loading";
    },

    isError() {
      return this.authStatus === "error";
    }
  },

  methods: {
    ...mapActions(["login"]),

    handleSubmit() {
      const user = {
        email: this.email,
        password: this.password
      };

      this.login(user)
        .then(response => {
          this.$router.push({ name: "home" });
        })
        .catch(error => (this.error = error.response.data.errors));
    }
  }
};
</script>

<style lang="scss">
.card-form-login {
  margin: 100px auto 0;
  max-width: 500px;
}
</style>
