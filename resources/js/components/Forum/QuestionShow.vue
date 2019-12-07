<template>
    <v-card
        class="mx-auto"
        outlined
        v-if="question"
    >
        <v-list-item three-line>
            <v-list-item-content>
                <div class="overline mb-4">{{question.title}}</div>
                <v-list-item-title class="headline mb-1">{{question.body}}}</v-list-item-title>
                <v-list-item-subtitle>{{question.user}} said {{question.created_at}}</v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item>
    </v-card>
</template>

<script>
    export default {
        name: "QuestionShow",
        props: {
            'question': Object
        }
    }
</script>

<style scoped>

</style>
