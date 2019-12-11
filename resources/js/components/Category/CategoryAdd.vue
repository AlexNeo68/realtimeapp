<template>
  <div>
    <v-card flat hover @submit.prevent="create">
      <v-form ref="form">
        <v-card-title>Create Category</v-card-title>
        <v-card-text>
          <v-alert type="error" v-if="error">{{error}}</v-alert>

          <div v-if="errors">
            <v-alert type="error" v-for="(error,key) in errors" :key="key">{{error}}</v-alert>
          </div>

          <v-text-field v-model="form.name" type="text" label="Category name" required></v-text-field>
        </v-card-text>

        <v-card-actions>
          <v-btn color="success" type="submit">Create</v-btn>
        </v-card-actions>
      </v-form>
    </v-card>

    <v-card class="mx-auto mt-10" tile>
      <v-list rounded>
        <v-header>
          <h3>Categories</h3>
        </v-header>
        <v-list-item-group color="primary">
          <v-list-item v-for="(category, i) in categories" :key="i">
            <v-list-item-content>
              <v-list-item-title v-text="category.name"></v-list-item-title>
              <v-list-item-actions>
                <v-btn icon>
                  <v-icon>mdi-anchor</v-icon>
                </v-btn>
              </v-list-item-actions>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-card>
  </div>
</template>

<script>
export default {
  data: () => ({
    form: {
      name: null
    },
    error: null,
    errors: null,
    categories: []
  }),
  methods: {
    async create() {
      try {
        const res = await axios.post("/api/categories", this.form);
        this.$router.push({ name: "forum" });
      } catch (error) {
        console.log(error.response);
        if (error.response.status == 422) {
          this.errors = error.response.data.errors;
        } else {
          this.error = error.response.data.message;
        }
      }
    }
  },
  async created() {
    try {
      const res = await axios.get("/api/categories");
      this.categories = res.data;
    } catch (error) {
      console.log(error.response);
    }
  }
};
</script>
