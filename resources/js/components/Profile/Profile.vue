<template>
    <v-menu
        bottom
        origin="center center"
        transition="scale-transition"
        v-if="profile"
    >
        <template v-slot:activator="{ on }">
            <v-btn text  v-on="on">
                {{profile.email}}
            </v-btn>
        </template>

        <v-list>
            <v-list-item>
                {{profile.name}}
            </v-list-item>
        </v-list>
    </v-menu>
</template>

<script>
    export default {
        name: "Profile",
        data(){
            return {
                profile: null
            }
        },
        created() {
            if (User.isLoggedIn()) this.getProfile();
        },
        methods: {
            async getProfile(){
                try{
                    const res = await axios.post(`/api/auth/me`);
                    this.profile = res.data;
                } catch(e) {
                    console.log(e.response);
                }
            }
        }
    }
</script>

<style scoped>

</style>
