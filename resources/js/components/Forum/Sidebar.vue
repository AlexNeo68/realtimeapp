<template>
  <v-card class="mx-auto" tile>
    <v-list rounded>
      <v-subheader>Categories</v-subheader>
      <v-list-item-group color="primary">
        <v-list-item v-for="(category, i) in categories" :key="i">
          <v-list-item-content>
            <v-list-item-title v-text="category.name"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list-item-group>
    </v-list>
  </v-card>
</template>
<script>
export default {
  data: () => ({
    categories: []
  }),
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
