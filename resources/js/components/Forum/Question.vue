<template>
  <question-show :data="question" v-if="question"></question-show>
</template>

<script>
import QuestionShow from "./QuestionShow";

export default {
  name: "Question",
  components: {
    "question-show": QuestionShow
  },
  data: () => ({
    question: null
  }),
  async created() {
    try {
      const res = await axios.get(`/api/questions/${this.$route.params.slug}`);
      this.question = res.data;
    } catch (e) {
      console.log(e.response);
    }
  }
};
</script>
