import { createRouter,createWebHistory } from "vue-router";
import Dashboard from '../views/Dashboard.vue';
import Login from '../views/Login.vue';
import Register from '../views/Register.vue';
import DefaultLayout from '../components/DefaultLayout.vue';
import Score from '../components/Score.vue';
import store from '../store/index.js';
import authLayout from '../components/authLayout.vue';
import SurveyView from '../views/SurveyView.vue';

const routes = [
    {
        path:'/',
        redirect:'/dashboard',
        name:'DefaultLayout',
        component: DefaultLayout,
        meta: {requireAuth: true},
        children:[
            {
                path:'/dashboard',
                name: 'Dashboard',
                component:Dashboard
            },
            {
                path:'/survey',
                name: 'Survey',
                component:Score
            },
            {
                path:'/survey/Create',
                name: 'surveyCreate',
                component:SurveyView
            },
        ]
    },
    {
        path: '/auth',
        name: 'Auth',
        redirect: '/login',
        meta:{isGuest:true},
        component: authLayout,
        children:[
            {
                path:'/login',
                name:'Login',
                component: Login
            },
            {
            path:'/register',
            name:'Register',
            component: Register
            },
        ],
    }
];
const router = createRouter({
    history: createWebHistory(),
    routes
});
router.beforeEach((to,from,next)=>{
    if(to.meta.requireAuth && !store.state.user.token){
        next({name:'Login'});
    }else if(store.state.user.token && to.meta.isGuest){
        next({name:'Dashboard'});
    }else{
        next();
    }
});
export default router