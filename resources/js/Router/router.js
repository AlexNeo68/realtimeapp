import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

const Login = require('../components/Login');

const routes = [{ path: '/login', component: Login }];

const router = new VueRouter({
    routes
});

export default router;
