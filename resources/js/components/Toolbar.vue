<template>
  <v-toolbar>
    <v-toolbar-title>
      <router-link to="/">ReakTimeForum</router-link>
    </v-toolbar-title>

    <v-spacer></v-spacer>

    <v-toolbar-items>
      <v-btn text v-for="item in items" :key="item.title" v-if="item.show">
        <router-link :to="item.to">{{item.title}}</router-link>
      </v-btn>
    </v-toolbar-items>
  </v-toolbar>
</template>

<script>
export default {
  data() {
    return {
      items: [
        { title: "Forum", to: "/forum", show: true },
        {
          title: "Ask Question",
          to: "/question-create",
          show: User.isLoggedIn()
        },
        { title: "Category", to: "/category-add", show: User.isLoggedIn() },
        { title: "Login", to: "/login", show: !User.isLoggedIn() },
        { title: "Logout", to: "/logout", show: User.isLoggedIn() }
      ]
    };
  },
  created() {
    EventBus.$on("logout", () => {
      User.logout();
    });
  }
};
</script>
