import axios from "axios";

export default {
  state: {
    items: [],
    item: null,
    status: ""
  },

  mutations: {
    formRequest(state) {
      state.status = "loading";
    },

    formError(state) {
      state.status = "error";
    },

    formSuccess(state) {
      state.status = "success";
    },

    setForms: (state, forms) => {
      state.items = forms;
    },

    setForm: (state, form) => {
      state.item = form;
    },

    addForm: (state, form) => {
      state.items.push(form);
    },

    removeForm: (state, id) => {
      state.items = state.items.filter(item => item.formId !== id);
    }
  },

  actions: {
    getForm: (context, id = 1) => {
      return new Promise((resolve, reject) => {
        context.commit("formRequest");

        axios
          .get(`${BASE_URL}/api/forms/${id}`)
          .then(response => {
            context.commit("setForm", response.data);
            context.commit("formSuccess");
            resolve(response);
          })
          .catch(error => reject(error));
      });
    },

    getForms: context => {
      return new Promise((resolve, reject) => {
        context.commit("formRequest");

        axios
          .get(`${BASE_URL}/api/forms`)
          .then(response => {
            context.commit("setForms", response.data);
            context.commit("formSuccess");
            resolve(response);
          })
          .catch(error => {
            context.commit("formError");
            reject(error);
          });
      });
    },

    saveForm: (context, name) => {
      return new Promise((resolve, reject) => {
        context.commit("formRequest");

        axios
          .post(`${BASE_URL}/api/forms/create`, { name })
          .then(response => {
            context.commit("formSuccess");
            context.commit("addForm", response.data);
            resolve(resolve);
          })
          .catch(error => {
            context.commit("formError");
            reject(error);
          });
      });
    },

    removeForm: (context, id) => {
      return new Promise((resolve, reject) => {
        context.commit("formRequest");

        axios
          .delete(`${BASE_URL}/api/forms/${id}/delete`)
          .then(response => {
            context.commit("removeForm", response.data.formId);
            context.commit("formSuccess");

            resolve(response);
          })
          .catch(error => reject(error));
      });
    }
  },

  getters: {
    countForms: state => state.items.length,

    allForms: state => state.items,
    formItem: state => state.item,
    formStatus: state => state.status
  }
};
