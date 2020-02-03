<template>
  <div class="page">
    <div class="page-main">
      <router-view />
    </div>
  </div>
</template>

<script>
import { mapMutations } from "vuex";
import { removeUserDataFromLocalStorage } from "../helpers/authHelper";

export default {
  methods: {
    ...mapMutations(["logout"])
  },

  created() {
    this.$http.interceptors.response.use(null, error => {
      // if does not match the token
      if (error.response.status === 401 && error.config) {
        this.logout();
        // remove user from localStorage
        removeUserDataFromLocalStorage();

        delete this.$http.defaults.headers.common["Authorization"];

        this.$router.push("/login");
      }

      throw error;
    });
  }
};
</script>

<style>
</style>