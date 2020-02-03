import Vue from "vue";
import Vuex from "vuex";

import auth from "./modules/auth";
import forms from "./modules/forms";
import questions from "./modules/questions";

Vue.use(Vuex);

const store = new Vuex.Store({
  strict: process.env.NODE_ENV !== "production",

  state: {
    test: "alex"
  },

  mutations: {},

  actions: {},

  getters: {},

  modules: {
    auth,
    forms,
    questions
  }
});

export default store;
