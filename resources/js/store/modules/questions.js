import axios from "axios";

export default {
  state: {
    items: [],
    status: ""
  },

  mutations: {
    setQuestionRequest: state => {
      state.status = "loading";
    },

    setQuestionSuccess: state => {
      state.status = "success";
    },

    setQuestionError: state => {
      state.status = "error";
    },

    setQuestion: (state, questions) => {
      state.items = questions;
    }
  },

  actions: {
    getTypeQuestions: context => {
      return new Promise((resolve, reject) => {
        context.commit("setQuestionRequest");

        axios
          .get(`${BASE_URL}/api/type-questions`)
          .then(response => {
            context.commit("setQuestion", response.data);
            context.commit("setQuestionSuccess");
            resolve(response);
          })
          .catch(error => reject(error));
      });
    }
  },

  getters: {
    allQuestions: state => state.items,
    questionStatus: state => state.status
  }
};
