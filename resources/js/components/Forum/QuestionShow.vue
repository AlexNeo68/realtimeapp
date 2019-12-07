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

        <v-card-actions>
            <v-btn small color="primary">Replies 5</v-btn>
            <div class="ml-2" v-if="own">
                <v-btn small color="success">
                    <v-icon>mdi-pencil</v-icon> Edit
                </v-btn>
                <v-btn small color="danger">
                    <v-icon>mdi-delete</v-icon> remove
                </v-btn>
            </div>

        </v-card-actions>
        <v-card-actions>

        </v-card-actions>


    </v-card>
</template>

<script>
    export default {
        name: "QuestionShow",
        props: {
            'question': Object
        },
        data: () => ({
            own: User.own(this.question.user_id)
        }),
    }
</script>

<style scoped>

</style>
