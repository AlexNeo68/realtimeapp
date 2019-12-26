<template>
    <v-btn small icon color="red" @click="likedIt">
        <v-icon>mdi-heart</v-icon> {{count}}
    </v-btn>
</template>

<script>
    export default {
        name: "Like",
        props: ['data'],
        data(){
            return {
                count: this.data.likes_count,
                liked: this.data.liked,
            }
        },
        methods: {
            likedIt(){
                this.liked ? this.decr() : this.inc();
                this.liked = !this.liked;
            },
            async inc(){
                try{
                    const res = await axios.post(`/api/replies/${this.data.id}/like`);
                    console.log(res.data);
                    this.count++;
                } catch(e) {
                    console.log(e.response);
                }
            },
            async decr(){
                try{
                    const res = await axios.delete(`/api/replies/${this.data.id}/unlike`);
                    console.log(res.data);
                    this.count--;
                } catch(e) {
                    console.log(e.response);
                }
            }
        }
    }
</script>
