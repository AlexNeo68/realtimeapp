import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Login from "../components/Auth/Login.vue";
import Signup from "../components/Auth/Signup.vue";
import Forum from "../components/Forum/Forum.vue";
import Logout from "../components/Auth/Logout";
import Question from "../components/Forum/Question";
import QuestionCreate from "../components/Forum/QuestionCreate";
import CategoryAdd from "../components/Category/CategoryAdd";
import Parallax from "../components/Parallax";

const routes = [
    { path: "/", component: Parallax },
    { path: "/login", component: Login },
    { path: "/signup", component: Signup },
    { path: "/forum", component: Forum, name: "forum" },
    { path: "/category-add", component: CategoryAdd, name: "categoryAdd" },
    { path: "/logout", component: Logout, name: "logout" },
    { path: "/questions/:slug", component: Question, name: "question" },
    {
        path: "/question-create",
        component: QuestionCreate,
        name: "question-create"
    }
];

const router = new VueRouter({
    routes,
    mode: "history"
});

export default router;
