<template>
	<v-toolbar>
		<v-toolbar-title>
			<router-link to="/">ReakTimeForum</router-link>
		</v-toolbar-title>

		<v-spacer></v-spacer>

		<v-toolbar-items>
			<v-btn text>
				<router-link to="/login">Login</router-link>
			</v-btn>
			<v-btn text>
				<router-link to="/forum">Forum</router-link>
			</v-btn>
			<v-btn text>Link 3</v-btn>
		</v-toolbar-items>
	</v-toolbar>
</template>

<script>
export default {};
</script>
