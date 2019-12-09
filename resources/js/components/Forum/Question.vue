<template>
  <div v-if="question">
    <question-edit :data="question" v-if="editing"></question-edit>
    <question-show :data="question" v-else></question-show>
  </div>
</template>

<script>
import QuestionShow from "./QuestionShow";
import QuestionEdit from "./QuestionEdit.vue";

export default {
  name: "Question",
  components: {
    "question-show": QuestionShow,
    "question-edit": QuestionEdit
  },
  data: () => ({
    question: null,
    editing: false
  }),
  created() {
    this.listen();
    this.getQuestion();
  },
  methods: {
    listen() {
      EventBus.$on("startEditing", () => {
        this.editing = true;
      });

      EventBus.$on("cancelEditing", () => {
        this.editing = false;
      });
    },
    async getQuestion() {
      try {
        const res = await axios.get(
          `/api/questions/${this.$route.params.slug}`
        );
        this.question = res.data;
      } catch (e) {
        console.log(e.response);
      }
    }
  }
};
</script>
