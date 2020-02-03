<template>
  <Master>
    <div class="container">
      <div v-if="!isLoadingForm">
        <div class="my-3 my-md-5">
          <div class="container">
            <div class="row">
              <div class="col col-md-3">
                <div v-if="!isLoadingQuestion">
                  <div class="question-nav list-group mb-0 list-group-transparent">
                    <Draggable :list="$store.state.questions.items" group="question" @change="log">
                      <div
                        class="question-nav-item list-group-item d-flex align-items-center mb-2"
                        v-for="question in allQuestions"
                        :key="question.id"
                      >
                        <span class="icon">
                          <i class="fe" :class="question.icon"></i>
                        </span>
                        {{ question.name }}
                      </div>
                    </Draggable>
                  </div>
                  <div class="mt-6">
                    <button class="btn btn-block btn-secondary">Добавить лист</button>
                  </div>
                </div>
                <div v-else>...loading</div>
              </div>
              <div class="col col-md-9">
                <div class="card p-3" v-for="sheet in formItem.formSheets" :key="sheet.id">
                  <div class="card mb-4">
                    <div class="card-header">
                      <div class="card-title">{{ sheet.title }}</div>
                    </div>

                    <Draggable class="list-group" :list="questions" group="question" @change="log">
                      <div
                        class="card-body"
                        v-for="sheetAnswer in sheet.sheet_answers"
                        :key="sheetAnswer.id"
                      >
                        <FormField :sheetAnswer="sheetAnswer" />
                      </div>
                    </Draggable>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else>...loading</div>
    </div>
  </Master>
</template>


<script>
import FormField from "./FormField";
import { mapGetters, mapActions } from "vuex";
export default {
  components: {
    FormField
  },

  data: () => ({
    questions: []
  }),

  computed: {
    ...mapGetters(["formItem", "formStatus", "allQuestions", "questionStatus"]),

    isLoadingForm() {
      return !this.formStatus || this.formStatus === "loading";
    },

    isLoadingQuestion() {
      return !this.questionStatus || this.questionStatus === "loading";
    }
  },

  methods: {
    ...mapActions(["getForm", "getTypeQuestions"]),

    log() {
      console.log(this);
    }
  },

  mounted() {
    this.getForm(this.$route.params.id);
    this.getTypeQuestions();
  }
};
</script>


<style lang="scss" scoped>
.question-nav {
  &-item {
    flex-direction: column;
    background-color: #fff;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    position: relative;
    margin-bottom: 1.5rem;
    width: 100%;
    cursor: pointer;

    &:hover {
      background-color: rgba(255, 255, 255, 0.4);
    }
  }
}
</style>