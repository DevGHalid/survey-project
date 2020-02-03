<template>
  <Master>
    <Panel @onClose="handleClosePanel" v-if="isConfirm">
      <FormPanelContentRemovalForm
        @onConfirm="handleConfirmRemoveForm"
        @onCancel="handleClosePanel"
      />
    </Panel>

    <div class="container">
      <div class="card">
        <div class="card-header justify-content-between">
          <h4 class="card-title">Списак формы</h4>
          <div class="form-btn-action">
            <button
              class="btn btn-sm btn-outline-cyan d-flex align-items-center"
              :disabled="isAddForm"
              @click="isAddForm = true"
            >
              <FontAwesomeIcon icon="plus" class="mr-2" />Добавить Форму
            </button>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-light table-hover">
            <thead>
              <tr>
                <th class="w-6">
                  <label class="custom-control custom-checkbox p-0 m-0">
                    <input
                      class="custom-control-input custom-control custom-checkbox"
                      type="checkbox"
                    />
                  </label>
                </th>
                <th scope="col">Создатель</th>
                <th scope="col">Названия</th>
                <th scope="col">Количества листов</th>
                <th scope="col">Дата</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="form in allForms" :key="form.formId">
                <th></th>
                <td>
                  <div class="nav-link p-0 leading-none">
                    <span class="avatar"></span>
                    <span class="ml-2 d-none d-lg-block">
                      <span class="text-default">{{ form.username }}</span>
                    </span>
                  </div>
                </td>
                <td>{{ form.formName }}</td>
                <td>{{ form.countSheets }}</td>
                <td>{{ form.formCreated }}</td>
                <td>
                  <div class="d-flex justify-content-end">
                    <template v-if="form.userId == userId">
                      <div class="form-action form-action-edit mr-3">
                        <button
                          class="btn btn-sm btn-outline-primary btn-pill d-flex align-items-center"
                          @click="handleRedirectToEditForm(form.formId)"
                        >
                          <FontAwesomeIcon icon="pencil-alt" class="mr-2" />Редактировать
                        </button>
                      </div>
                      <div class="form-action form-action-remove">
                        <button
                          class="btn btn-sm btn-outline-danger btn-pill d-flex align-items-center"
                          @click="handleRemoveForm(form)"
                        >
                          <FontAwesomeIcon icon="trash-alt" class="mr-2" />Удалить
                        </button>
                      </div>
                    </template>
                    <template v-else>
                      <div class="form-action form-action-edit mr-3">
                        <button
                          class="btn btn-sm btn-outline-primary btn-pill d-flex align-items-center"
                        >
                          <FontAwesomeIcon icon="copy" class="mr-2" />Копировать
                        </button>
                      </div>
                      <div class="form-action form-action-remove">
                        <button
                          class="btn btn-sm btn-outline-info btn-pill d-flex align-items-center"
                        >
                          <FontAwesomeIcon icon="eye" class="mr-2" />Обзор
                        </button>
                      </div>
                    </template>
                  </div>
                </td>
              </tr>
              <FormAdd
                v-if="isAddForm"
                :username="username"
                @onAddForm="handleAddForm"
                @onClose="isAddForm = false"
              />
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </Master>
</template>

<script>
import FormAdd from "./FormAdd";
import Panel from "../../components/Panel";
import FormPanelContentRemovalForm from "./FormPanelContentRemovalForm";
import { mapState, mapActions, mapMutations } from "vuex";

export default {
  components: {
    FormAdd,
    Panel,
    FormPanelContentRemovalForm
  },

  props: ["formName"],

  data: () => ({
    isAddForm: false,
    isConfirm: false,

    removeItemForm: null
  }),

  computed: {
    ...mapState(["auth", "forms"]),

    userId() {
      return this.auth.userId;
    },

    username() {
      return this.auth.username;
    },

    allForms() {
      return this.forms.items;
    }
  },

  methods: {
    ...mapActions(["getForms", "saveForm", "removeForm"]),

    handleAddForm(formName) {
      this.saveForm(formName);
      this.isAddForm = false;
    },

    handleRedirectToEditForm(formId) {
      this.$router.push({ name: "forms.edit", params: { id: formId } });
    },

    handleRemoveForm(form) {
      this.removeItemForm = form;
      this.handleOpenPanel();
    },

    handleConfirmRemoveForm() {
      if (!this.removeItemForm) return;
      if (!this.removeItemForm.formId) return;

      this.removeForm(this.removeItemForm.formId)
        .then(response => {
          this.removeItemForm = null;
          this.handleClosePanel();
        })
        .finally(() => {});
    },

    handleOpenPanel() {
      this.isConfirm = true;
    },

    handleClosePanel() {
      this.isConfirm = false;

      if (this.removeItemForm) {
        this.removeItemForm = null;
      }
    }
  },

  mounted() {
    this.getForms();
  }
};
</script>

