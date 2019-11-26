<template>
	<v-card flat hover @submit.prevent="signup">
		<v-form ref="form" lazy-validation>
			<v-card-title>Signup</v-card-title>
			<v-card-text>
				<!-- <v-alert type="error" v-if="error">{{error}}</v-alert> -->
				<v-text-field v-model="form.name" type="text" label="Name" required></v-text-field>
				<span class="error--text" v-if="error.name">{{error.name[0]}}</span>
				<v-text-field v-model="form.email" type="email" label="E-mail" required></v-text-field>
				<span class="error--text" v-if="error.email">{{error.email[0]}}</span>
				<v-text-field v-model="form.password" type="password" label="Password" required></v-text-field>
				<span class="error--text" v-if="error.password">{{error.password[0]}}</span>
				<v-text-field
					v-model="form.password_confirmation"
					type="password_confirmation"
					label="Password Confirm"
					required
				></v-text-field>
			</v-card-text>

			<v-card-actions>
				<v-btn color="success" type="submit">Signup</v-btn>
				<router-link to="/login" class="ml-5">
					<v-btn color="info">Login</v-btn>
				</router-link>
			</v-card-actions>
		</v-form>
	</v-card>
</template>

<script>
export default {
	data: () => ({
		form: {
			name: null,
			email: null,
			password: null,
			password_confirmation: null
		},
		error: {
			name: null,
			email: null,
			password: null
		}
	}),
	methods: {
		signup() {
			this.error = User.signup(this.form, this.$router);
		}
	}
};
</script>
