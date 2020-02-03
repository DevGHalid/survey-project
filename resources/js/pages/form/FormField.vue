<template>
  <div>
    <label>{{ answer.label }}</label>
    <input class="form-control" type="text" :value="answer.value" :placeholder="answer.placeholder" />
    <small>{{ answer.comment }}</small>
  </div>
</template>

<script>
export default {
  props: {
    sheetAnswer: {
      type: Object,
      default: {}
    }
  },

  computed: {
    answer() {
      return this.sheetAnswer || this.sheetAnswer.answer;
    }
  },

  mounted() {
    console.log();
  }
};
</script>