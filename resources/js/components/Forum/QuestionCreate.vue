<template>
  <v-card flat hover @submit.prevent="store">
    <v-form ref="form">
      <v-card-title>Create Question</v-card-title>
      <v-card-text>
        <v-alert type="error" v-if="error">{{error}}</v-alert>

        <div v-if="errors">
          <v-alert type="error" v-for="(error,key) in errors" :key="key">{{error[0]}}</v-alert>
        </div>

        <v-text-field v-model="form.title" type="text" label="Title" required></v-text-field>
          <div class="error--text mb-5" v-if="errors&&errors.title">{{errors.title[0]}}</div>
        <v-select
          v-model="form.category_id"
          :items="categories"
          item-text="name"
          item-value="id"
          label="Category"
        ></v-select>
          <div class="error--text mb-5" v-if="errors&&errors.category_id">{{errors.category_id[0]}}</div>

        <vue-simplemde v-model="form.body" />
          <div class="error--text mb-5" v-if="errors&&errors.body">{{errors.body[0]}}</div>
      </v-card-text>

      <v-card-actions>
        <v-btn color="success" type="submit" :disabled="disabled">Ask</v-btn>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script>
export default {
  name: "QuestionCreate",
  data: () => ({
    form: {
      title: null,
      category_id: null,
      body: null
    },
    categories: [],
    errors: null,
    error: null
  }),
    computed: {
      disabled(){
          return false;
          // return !this.form.title || !this.form.category_id || !this.form.body
      }
    },
  async created() {
    try {
      const res = await axios.get(`/api/categories`);
      this.categories = res.data;
    } catch (e) {
      console.log(e.response);
    }
  },
  methods: {
    async store() {
      try {
        let res = await axios.post("/api/questions", this.form);
        console.log(res);
        this.$router.push({name: 'forum'});
      } catch (e) {
        console.log(e.response);
        if (e.response.status == 400) {
          this.error = e.response.data.error;
        }
        if (e.response.status == 422) {
          this.errors = e.response.data.errors;
        }
      }
    }
  }
};
</script>

<style scoped>
</style>
