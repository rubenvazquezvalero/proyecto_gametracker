import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'

Vue.use(VueRouter)

/* Guest Component */
import Login from '../components/Login.vue';
import Register from '../components/Register.vue';
/* Guest Component */

/* Layouts */
import DahboardLayout from '../components/layouts/Dashboard.vue';
/* Layouts */

/* Authenticated Component */
import Dashboard from '../components/Dashboard.vue';
/* Authenticated Component */

import Juegos from '../components/Juegos.vue';


const Routes = [
    {
        name:"login",
        path:"/login",
        component:Login,
        meta:{
            middleware:"guest",
            title:`Login`
        }
    },
    {
        name:"register",
        path:"/register",
        component:Register,
        meta:{
            middleware:"guest",
            title:`Register`
        }
    },
    {
        name:"games",
        path:"/games",
        component:Juegos,
        meta:{
            middleware:"all",
            title:`Juegos`
        }
    },
/*     {
        path:"/",
        component:DahboardLayout,
        meta:{
            middleware:"auth"
        },
        children:[
            
        ]
    }, */
    {
        name:"dashboard",
        path: '/',
        component: Dashboard,
        meta:{
            middleware:"auth",
            title:`Dashboard`
        }
    }
]

var router  = new VueRouter({
    mode: 'history',
    routes: Routes
})

router.beforeEach((to, from, next) => {
    document.title = `${to.meta.title} - ${process.env.MIX_APP_NAME}`
    if (to.meta.middleware=="all") {
        next()
    }else if(to.meta.middleware=="guest"){
        if(store.state.auth.authenticated){
            next({name:"dashboard"})
        }
        next()
    }else{
        if(store.state.auth.authenticated){
            next()
        }else{
            next({name:"login"})
        }
    }
})

export default router