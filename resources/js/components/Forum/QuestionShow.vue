<template>
	<div>
		<v-card class="mx-auto" outlined>
			<v-card-title>
				<div>
					<div class="headline mb-1">{{data.title}}</div>
					<div class="grey--text">{{data.user}} said {{data.created_at}}</div>
				</div>
				<v-spacer></v-spacer>
				<v-btn primary color="green">{{replies_count}} replies</v-btn>
			</v-card-title>

			<v-card-text v-html="body"></v-card-text>

			<v-card-actions v-if="own">
				<v-btn small icon color="orange" @click="initUpdate">
					<v-icon>mdi-pencil</v-icon>
				</v-btn>
				<v-btn small icon color="red" @click="destroy">
					<v-icon>mdi-delete</v-icon>
				</v-btn>
			</v-card-actions>
		</v-card>
		<replies :data="data" class="mt-5"></replies>
	</div>
</template>

<script>
import Replies from '../Reply/Replies';

export default {
	components: { Replies },
	name: 'QuestionShow',
	props: ['data'],
	data(){
	    return {
		own: false,
        replies_count: this.data.replies_count}
	},
    created(){
        this.listen();
    },
	mounted() {
		this.own = User.own(this.data.user_id);
	},
	computed: {
		body() {
			return md.parse(this.data.body);
		},
	},
	methods: {
	    listen(){
            EventBus.$on("newReply", () => {
                this.replies_count++;
            });
            EventBus.$on("deleteReply", () => {
                this.replies_count--;
            });
            Echo.private('App.User.' + User.id())
                .notification((notification) => {
                    this.replies_count++;
                });
            Echo.channel('DeleteReplyChannel')
                .listen('DeleteReplyEvent', (e) => {
                    this.replies_count--;
                });
        },
		initUpdate() {
			EventBus.$emit('startEditing');
		},
		async destroy() {
			try {
				const res = await axios.delete(`/api/questions/${this.data.slug}`);
				this.$router.push({ name: 'forum' });
			} catch (error) {
				console.log(error.response);
			}
		}
	}
};
</script>
