<template>
  <div>
    <v-card flat hover>
      <v-card-title>Add Reply</v-card-title>
      <v-card-text>
        <vue-simplemde v-model="body" />
      </v-card-text>

      <v-card-actions>
        <v-btn color="success" type="submit" @click="submit" :disabled="disabled">Reply</v-btn>
      </v-card-actions>
    </v-card>
  </div>
</template>
<script>
export default {
  props: ["qslug"],
  data() {
    return {
      body: null
    };
  },
  methods: {
    async submit() {
      try {
        const res = await axios.post(`/api/questions/${this.qslug}/replies`, {
          body: this.body
        });
        this.body = "";
        EventBus.$emit("newReply", res.data);
        window.scrollTo(0, 0);
      } catch (error) {
        console.log(error.response);
      }
    }
  },
    computed: {
      disabled(){
          return !this.body;
      }
    }
};
</script>
