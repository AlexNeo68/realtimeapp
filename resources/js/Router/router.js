import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Login from '../components/Auth/Login.vue';
import Signup from '../components/Auth/Signup.vue';
import Forum from '../components/Forum/Forum.vue';
import Logout from "../components/Auth/Logout";

const routes = [
	{ path: '/login', component: Login },
	{ path: '/signup', component: Signup },
	{ path: '/forum', component: Forum, name: 'forum' },
	{ path: '/logout', component: Logout, name: 'logout' },
];

const router = new VueRouter({
	routes,
	mode: 'history'
});

export default router;
