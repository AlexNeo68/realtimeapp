<template>
	<v-card class="mt-5">
		<v-card-title>{{data.user}} said {{data.created_at}}</v-card-title>
		<div>
			<reply-edit v-if="edit" :data="data"></reply-edit>
			<div v-else>
				<v-card-text v-html="body"></v-card-text>
				<v-card-actions v-if="own">
					<v-btn small icon color="orange" @click="update">
						<v-icon>mdi-pencil</v-icon>
					</v-btn>
					<v-btn small icon color="red" @click="destroy">
						<v-icon>mdi-delete</v-icon>
					</v-btn>
				</v-card-actions>
			</div>
		</div>
	</v-card>
</template>
<script>
import ReplyEdit from './ReplyEdit';
export default {
	components: { ReplyEdit },
	props: ['data', 'qslug'],
	data() {
		return {
			edit: false,
			bodyBeforeUpdate: ''
		};
	},
	computed: {
		own() {
			return User.own(this.data.user_id);
		},
		body() {
			return md.parse(this.data.body);
		}
	},
	created() {
		this.listen();
	},
	methods: {
		update() {
			this.edit = true;
			this.bodyBeforeUpdate = this.data.body;
		},
		destroy() {
			EventBus.$emit('deleteReply', this.data.id);
		},
		listen() {
			EventBus.$on('cancelReplyEdit', body => {
				this.edit = false;
				if (body !== this.data.body) {
					this.data.body = this.bodyBeforeUpdate;
					this.bodyBeforeUpdate = '';
				}
			});
		}
	}
};
</script>
