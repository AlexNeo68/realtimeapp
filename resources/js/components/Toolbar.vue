<template>
	<v-toolbar color="indigo" dark>
		<v-toolbar-title>
			<router-link to="/" class="white--text">ReakTimeForum</router-link>
		</v-toolbar-title>

		<v-spacer></v-spacer>

		<v-toolbar-items>
            <app-notifications v-if="loggedIn"></app-notifications>
			<v-btn text v-for="item in items" :key="item.title" v-if="item.show">
				<router-link :to="item.to" class="white--text">{{item.title}}</router-link>
			</v-btn>
            <profile></profile>
		</v-toolbar-items>
	</v-toolbar>
</template>

<script>
    import AppNotifications from './AppNotifications';
    import Profile from './Profile/Profile';
export default {
    components: {AppNotifications, Profile},
	data() {
		return {
		    loggedIn: User.isLoggedIn(),
			items: [
				{ title: 'Forum', to: '/forum', show: true },
				{
					title: 'Ask Question',
					to: '/question-create',
					show: User.isLoggedIn()
				},
				{ title: 'Category', to: '/category-add', show: User.isAdmin() },
				{ title: 'Login', to: '/login', show: !User.isLoggedIn() },
				{ title: 'Logout', to: '/logout', show: User.isLoggedIn() }
			]
		};
	},
	created() {
		EventBus.$on('logout', () => {
			User.logout();
		});
	}
};
</script>
