<template>
	<div>
		<v-card flat hover @submit.prevent="submit">
			<v-form ref="form">
				<v-card-title>Create Category</v-card-title>
				<v-card-text>
					<v-alert type="error" v-if="error">{{error}}</v-alert>

					<div v-if="errors">
						<v-alert type="error" v-for="(error,key) in errors" :key="key">{{error}}</v-alert>
					</div>

					<v-text-field v-model="form.name" type="text" label="Category name" required></v-text-field>
				</v-card-text>

				<v-card-actions>
					<v-btn color="orange" type="submit" v-if="editSlug">Update</v-btn>
					<v-btn color="success" type="submit" v-else>Create</v-btn>
				</v-card-actions>
			</v-form>
		</v-card>

		<v-card class="mx-auto my-10">
			<v-toolbar color="light-blue" dark>
				<v-toolbar-title>Categories</v-toolbar-title>
			</v-toolbar>

			<v-list two-line subheader>
				<v-list-item v-for="(category,key) in categories" :key="key">
					<v-list-item-avatar>
						<v-btn small icon color="orange" @click="startUpd(key)">
							<v-icon>mdi-pencil</v-icon>
						</v-btn>
					</v-list-item-avatar>

					<v-list-item-content>
						<v-list-item-title v-text="category.name"></v-list-item-title>
					</v-list-item-content>

					<v-list-item-action>
						<v-btn small icon color="red" @click="destroy(category.slug, key)">
							<v-icon>mdi-delete</v-icon>
						</v-btn>
					</v-list-item-action>
				</v-list-item>
			</v-list>
		</v-card>
	</div>
</template>

<script>
export default {
	data: () => ({
		form: {
			name: null
		},
		editSlug: null,
		error: null,
		errors: null,
		categories: []
	}),
	methods: {
		submit() {
			if (this.editSlug) {
				this.update();
			} else {
				this.create();
			}
		},
		async create() {
			try {
				const res = await axios.post('/api/categories', this.form);
				this.categories.unshift(res.data);
				this.form.name = '';
			} catch (error) {
				console.log(error.response);
				if (error.response.status == 422) {
					this.errors = error.response.data.errors;
				} else {
					this.error = error.response.data.message
						? error.response.data.message
						: error.response.data.error;
				}
			}
		},
		startUpd(key) {
			this.form.name = this.categories[key].name;
			this.categories.splice(key, 1);
			this.editSlug = this.categories[key].slug;
		},
		async update() {
			try {
				const res = await axios.patch(
					`/api/categories/${this.editSlug}`,
					this.form
				);
				this.categories.unshift(res.data);
				this.form.name = '';
				this.editSlug = null;
			} catch (error) {
				console.log(error.response);
				if (error.response.status == 422) {
					this.errors = error.response.data.errors;
				} else {
					this.error = error.response.data.message
						? error.response.data.message
						: error.response.data.error;
				}
			}
		},
		async destroy(slug, key) {
			try {
				const res = await axios.delete(`/api/categories/${slug}`);
				this.categories.splice(key, 1);
			} catch (error) {
				console.log(error.response);
				this.error = error.response.data.message
					? error.response.data.message
					: error.response.data.error;
			}
		}
	},
	async created() {
		if (!User.isAdmin()) this.$router.push({ name: 'forum' });
		try {
			const res = await axios.get('/api/categories');
			this.categories = res.data;
		} catch (error) {
			console.log(error.response);
		}
	}
};
</script>
