<template>
  <v-card flat hover @submit.prevent="update">
    <v-form ref="form">
      <v-card-title>Update Question</v-card-title>
      <v-card-text>
        <v-alert type="error" v-if="error">{{error}}</v-alert>

        <div v-if="errors">
          <v-alert type="error" v-for="(error,key) in errors" :key="key">{{error}}</v-alert>
        </div>

        <v-text-field v-model="form.title" type="text" label="Title" required></v-text-field>
        <v-select
          v-model="form.category_id"
          :items="categories"
          item-text="name"
          item-value="id"
          label="Category"
          :value="form.category_id"
        ></v-select>

        <vue-simplemde v-model="form.body" />
      </v-card-text>

      <v-card-actions>
        <v-btn color="orange" type="submit">Update</v-btn>
        <v-btn color="grey" @click="cancel">Cancel</v-btn>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script>
export default {
  name: "QuestionEdit",
  props: ["data"],
  data: () => ({
    form: {
      title: null,
      body: null
    },
    categories: [],
    errors: null,
    error: null
  }),
  async created() {
    try {
      const res = await axios.get(`/api/categories`);
      this.categories = res.data;
    } catch (e) {
      console.log(e.response);
    }
    this.form = this.data;
  },
  methods: {
    cancel() {
      EventBus.$emit("cancelEditing");
    },
    async update() {
      try {
        let res = await axios.patch(
          `/api/questions/${this.form.slug}`,
          this.form
        );
        console.log(res);
        this.cancel();
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
