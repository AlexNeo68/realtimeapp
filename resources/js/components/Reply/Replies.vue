<template>
  <div>
    <h1>Replies</h1>
    <reply v-for="(reply) in replies" :key="reply.id" :data="reply"></reply>
    <reply-add :qslug="data.slug" class="mt-5"></reply-add>
  </div>
</template>
<script>
import Reply from "./Reply";
import ReplyAdd from "./ReplyAdd";
export default {
  props: ["data"],
  components: { Reply, ReplyAdd },
  data() {
    return {
      replies: this.data.replies
    };
  },
  created() {
    this.listen();
  },
  methods: {
    listen() {
      EventBus.$on("newReply", reply => {
        this.replies.unshift(reply);
      });
      EventBus.$on("deleteReply", async id => {
        try {
          await axios.delete(`/api/questions/${this.data.slug}/replies/${id}`);
          this.replies = this.replies.filter(reply => reply.id !== id);
        } catch (error) {
          console.log(error.response);
        }
      });
    }
  }
};
</script>
