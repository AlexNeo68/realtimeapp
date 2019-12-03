<template>
  <v-card flat hover @submit.prevent="login">
    <v-form ref="form">
      <v-card-title>Login</v-card-title>
      <v-card-text>
        <v-alert type="error" v-if="error">{{error}}</v-alert>
        <v-text-field v-model="form.email" type="email" label="E-mail" required></v-text-field>
        <v-text-field v-model="form.password" type="password" label="Password" required></v-text-field>
      </v-card-text>

      <v-card-actions>
        <v-btn color="success" type="submit">LogIn</v-btn>
        <router-link to="signup" class="ml-5">
          <v-btn color="info">Signup</v-btn>
        </router-link>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script>
export default {
  data: () => ({
    form: {
      email: null,
      password: null
    },
    error: null
  }),
    created(){
      if (User.isLoggedIn()) this.$router.push({name:'forum'});
    },
  methods: {
    login() {
      User.login(this.form, this.$router);
    }
  }
};
</script>
