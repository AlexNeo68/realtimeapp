<template>
	<v-card class="mt-5">
		<v-card-text>
			<vue-simplemde v-model="data.body" />
		</v-card-text>
		<v-card-actions>
			<v-btn small icon color="orange" @click="update">
				<v-icon>mdi-content-save</v-icon>
			</v-btn>
			<v-btn small icon color="red" @click="cancel">
				<v-icon>mdi-cancel</v-icon>
			</v-btn>
		</v-card-actions>
	</v-card>
</template>
<script>
export default {
	props: ['data'],
	methods: {
		async update() {
			try {
				const res = await axios.patch(
					`/api/questions/${this.data.question_slug}/replies/${this.data.id}`,
					{
						body: this.data.body
					}
				);
				this.cancel(this.data.body);
			} catch (error) {
				console.log(error.response);
			}
		},
		cancel(data) {
			EventBus.$emit('cancelReplyEdit', data);
		}
	}
};
</script>
