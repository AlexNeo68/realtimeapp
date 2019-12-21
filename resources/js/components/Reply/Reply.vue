<template>
  <v-card class="mt-5">
    <v-card-title>{{data.user}}[{{data.user_id}}] said {{data.created_at}}</v-card-title>
    <v-card-text v-html="data.body"></v-card-text>
    <v-card-actions v-if="own">
      <v-btn small icon color="orange">
        <v-icon>mdi-pencil</v-icon>
      </v-btn>
      <v-btn small icon color="red" @click="destroy">
        <v-icon>mdi-delete</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>
<script>
export default {
  props: ["data", "qslug"],
  computed: {
    own() {
      return User.own(this.data.user_id);
    }
  },
  methods: {
    destroy() {
      EventBus.$emit("deleteReply", this.data.id);
    }
  }
};
</script>
