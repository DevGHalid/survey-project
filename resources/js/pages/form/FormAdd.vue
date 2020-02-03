<template>
  <tr>
    <th></th>
    <td>
      <div class="nav-link p-0 leading-none">
        <span class="avatar"></span>
        <span class="ml-2 d-none d-lg-block">
          <span class="text-default">{{ username }}</span>
        </span>
      </div>
    </td>
    <td>
      <input class="form-control form-control-sm w-75" v-model="formName" />
      <small class="text-danger" v-if="isError">Поле не может быть пустым</small>
    </td>
    <td>0</td>
    <td>Дата добавится после сохранения</td>
    <td>
      <div class="d-flex justify-content-end">
        <div class="form-action form-action-edit mr-3">
          <button
            class="btn btn-sm btn-outline-cyan btn-pill d-flex align-items-center"
            @click="handleAddForm"
          >
            <FontAwesomeIcon icon="save" class="mr-2" />Сохранить
          </button>
        </div>
        <div class="form-action form-action-remove">
          <button
            class="btn btn-sm btn-outline-cyan btn-pill d-flex align-items-center"
            @click="handleClose"
          >
            <FontAwesomeIcon icon="times" class="mr-2" />Отменить
          </button>
        </div>
      </div>
    </td>
  </tr>
</template>

<script>
export default {
  props: {
    username: {
      type: String,
      default: "Нет имени"
    }
  },

  data: () => ({
    formName: "",
    isError: false
  }),

  methods: {
    handleAddForm() {
      // if empty
      if (!this.formName) {
        this.isError = true;
      } else {
        this.$emit("onAddForm", this.formName);
      }
    },

    handleClose() {
      this.$emit("onClose");
    }
  }
};
</script>