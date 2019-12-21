<template>
	<v-card class="mt-5">
		<v-card-title>{{data.user}} said {{data.created_at}}</v-card-title>
		<v-card-text v-html="data.body"></v-card-text>
		<v-card-actions v-if="own">
			<v-btn small icon color="orange">
				<v-icon>mdi-pencil</v-icon>
			</v-btn>
			<v-btn small icon color="red">
				<v-icon>mdi-delete</v-icon>
			</v-btn>
		</v-card-actions>
	</v-card>
</template>
<script>
export default {
	props: ['data'],
	computed: {
		own() {
			return User.own(this.data.user_id);
		}
	}
};
</script>
