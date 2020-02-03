import axios from "axios";
import {
  saveUserDataToLocalStorage,
  removeUserDataFromLocalStorage,
  getUserDataFromLocalStorage,
  checkAuthenticated
} from "../../helpers/authHelper";

const user = getUserDataFromLocalStorage();

export default {
  state: {
    userId: user.userId,
    username: user.name,
    accessToken: user.accessToken,
    status: ""
  },

  mutations: {
    loginRequest(state) {
      state.status = "loading";
    },

    loginSuccess(state, user) {
      state.userId = user.userId;
      state.username = user.name;
      state.accessToken = user.accessToken;

      state.status = "success";
    },

    loginError(state) {
      state.status = "error";
    },

    logout(state) {
      state.accessToken = "";
      state.userId = "";
      state.username = "";

      state.status = "";
    }
  },

  actions: {
    login(context, user) {
      return new Promise((resolve, reject) => {
        context.commit("loginRequest");

        axios
          .post(`${BASE_URL}/api/auth/login`, user)
          .then(response => {
            const user = response.data;

            saveUserDataToLocalStorage(user);

            const bearer = `Bearer ${user.accessToken}`;

            axios.defaults.headers.common["Authorization"] = bearer;

            context.commit("loginSuccess", user);

            resolve(response);
          })
          .catch(error => {
            context.commit("loginError");

            reject(error);
          });
      });
    },

    logout(context) {
      return new Promise((resolve, reject) => {
        axios
          .post(`${BASE_URL}/api/auth/logout`)
          .then(response => {
            context.commit("logout");
            // remove user from localStorage
            removeUserDataFromLocalStorage();

            delete axios.defaults.headers.common["Authorization"];

            resolve(response);
          })
          .catch(error => {
            reject(error);
          });
      });
    }
  },

  getters: {
    isAuthenticated: state => checkAuthenticated(state),
    authStatus: state => state.status
  }
};
