<template>
  <div>
    <h1>Replies</h1>
    <reply v-for="(reply) in replies" :key="reply.id" :data="reply"></reply>
    <reply-add v-if="isLogged" :qslug="data.slug" class="mt-5"></reply-add>
      <div v-else class="mt-4">
          <router-link to="/login">LogIn to reply</router-link>
      </div>
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
    computed: {
      isLogged(){
        return User.isLoggedIn();
      }
    },
  methods: {
    listen() {
      EventBus.$on("newReply", reply => {
        this.replies.unshift(reply);
        window.scroll(0,0);
      });
      EventBus.$on("deleteReply", async id => {
        try {
          await axios.delete(`/api/questions/${this.data.slug}/replies/${id}`);
          this.replies = this.replies.filter(reply => reply.id !== id);
        } catch (error) {
          console.log(error.response);
        }
      });
        Echo.private('App.User.' + User.id())
            .notification((notification) => {
                console.log(notification);
                this.replies.unshift(notification.reply);
            });
        Echo.channel('DeleteReplyChannel')
            .listen('DeleteReplyEvent', (e) => {
                this.replies = this.replies.filter(reply => reply.id!==e.id);
            });
    }
  }
};
</script>
