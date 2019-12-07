<template>
    <div>
        <h1>Forum</h1>
        <v-row>
            <v-col
                cols="12"
                sm="8"
            >
                <question class="mb-2" v-for="question in questions" :key="question.id" :data="question"></question>
            </v-col>
            <v-col sm="4"> sidebar </v-col>
        </v-row>
    </div>
</template>
<script>
    import Question from "./Questions";
    export default {
        components: {
            Question
        },
        data: ()=>({
            questions: []
        }),
        async created() {
            try {
                let res = await axios.get(`api/questions`);
                this.questions = res.data.data;
            } catch(err){
                console.log(err.response);
            }
        }
    }
</script>
