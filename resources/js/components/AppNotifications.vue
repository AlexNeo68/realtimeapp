<template>
    <div>
        <v-menu
            bottom
            origin="center center"
            transition="scale-transition"
        >
            <template v-slot:activator="{ on }">
                <v-btn text icon :color="colorIcon"  v-on="on">
                    <v-icon>mdi-bell</v-icon> {{unReadCount}}
                </v-btn>
            </template>

            <v-list>
                <v-list-item v-for="notification in unReadNotifications" :key="notification.id" @click="readIt(notification)">
                    <router-link :to="notification.path">
                        <v-list-item-title>{{notification.question}}</v-list-item-title>
                    </router-link>
                </v-list-item>
                <v-divider></v-divider>
                <v-list-item v-for="notification in readNotifications" :key="notification.id">
                    <v-list-item-title>{{notification.question}}</v-list-item-title>
                </v-list-item>

            </v-list>
        </v-menu>
    </div>


</template>

<script>
    export default {
        name: "AppNotifications",
        data: () => ({
            readNotifications: [],
            unReadNotifications: [],
            unReadCount: 0,
            colorIcon: 'red lighten-5'
        }),
        created() {
            if(User.isLoggedIn()){
                this.getReadNotifications();
                this.getUnReadNotifications();
            }

            Echo.private('App.User.' + User.id())
                .notification((notification) => {
                    this.playSound();
                    this.unReadNotifications.unshift(notification);
                    this.unReadCount++;
                });
        },
        methods: {
            playSound(){
                let sound = new Audio('https://freesound.org/data/previews/501/501697_1648170-lq.mp3');
                sound.play();
            },
            async getReadNotifications(){
                try {
                    const res = await axios.get('/api/readnotifications');
                    this.readNotifications = res.data.data;
                } catch (e) {
                    console.log(e.response);
                    Exception.error(e);
                }
            },
            async getUnReadNotifications(){
                try {
                    const res = await axios.get('/api/unreadnotifications');
                    this.unReadNotifications = res.data.data;
                    if( this.unReadNotifications.length > 0){
                        this.unReadCount = this.unReadNotifications.length;
                        this.colorIcon = 'red darken-4';
                    }
                } catch (e) {
                    console.log(e.response);
                }
            },
            async readIt(notification){
                try {
                    const res = await axios.post('/api/markasread', {id: notification.id});
                    this.unReadNotifications = this.unReadNotifications.filter(nn=>nn.id!=notification.id);
                    if( this.unReadNotifications.length > 0){
                        this.unReadCount = this.unReadNotifications.length;
                        this.colorIcon = 'red darken-4';
                    }
                } catch (e) {
                    console.log(e.response);
                }
            }
        }
    }
</script>
