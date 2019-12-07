<template>
    <v-card
        class="mx-auto"
        outlined
    >
        <v-list-item two-line>
            <v-list-item-content>
                <div class="overline mb-4">
                    <router-link :to="data.path">
                        {{data.title}}
                    </router-link>
                </div>
                <v-list-item-title class="headline mb-1">{{data.body}}</v-list-item-title>
                <v-list-item-subtitle>said on {{ data.created_at }}</v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item>

    </v-card>
</template>

<script>
    export default {
        name: "Question",
        props: {
            data: Object
        }
    }
</script>

<style scoped>

</style>
