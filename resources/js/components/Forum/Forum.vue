<template>
	<div>
		<h1>Forum</h1>
		<v-row>
			<v-col cols="12" sm="8">
				<question class="mb-2" v-for="question in questions" :key="question.id" :data="question"></question>
				<div class="text-center">
					<v-pagination v-model="meta.current_page" :length="meta.total" circle @input="getQuestions"></v-pagination>
				</div>
			</v-col>
			<v-col sm="4">
				<sidebar></sidebar>
			</v-col>
		</v-row>
	</div>
</template>
<script>
import Question from './Questions';
import Sidebar from './Sidebar';
export default {
	components: {
		Question,
		Sidebar
	},
	data: () => ({
		questions: [],
		meta: {}
	}),
	async created() {
		this.getQuestions();
	},
	methods: {
		async getQuestions(page) {
			try {
				let url = page ? `api/questions?page=${page}` : `api/questions`;
				let res = await axios.get(url);
				this.questions = res.data.data;
				this.meta = res.data.meta;
			} catch (err) {
				console.log(err.response);
			}
		}
	}
};
</script>
