import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'

Vue.use(VueRouter)


import Principal from '../components/layouts/Principal.vue';

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
import Juego from '../components/Juego.vue';
import Perfil from '../components/Perfil.vue';
/* Admin */
import IndexAdmin from '../components/admin/Index.vue';
import JuegosAdmin from '../components/admin/Juegos.vue';

import PageNotFound from '../components/404.vue';


const Routes = [
    {
        name: "admin",
        path: '/admin',
        component: IndexAdmin,
        meta: {
            middleware: "auth",
            title: `Administración`
        },
        children: [
            {
                name: 'juegos',
                path: "/admin/juegos",
                component:  JuegosAdmin,
                meta: {
                    middleware: "auth",
                    title: `Administración Juegos`
                }
            }
        ]
        
    },
    {
        name: "principal",
        path: "/",
        component: Principal,
        meta: {
            middleware: "guest",
            title: `Principal`
        },
        children: [
            {
                name: "login",
                path: "/login",
                component: Login,
                meta: {
                    middleware: "guest",
                    title: `Login`
                }
            },
            {
                name: "register",
                path: "/register",
                component: Register,
                meta: {
                    middleware: "guest",
                    title: `Register`
                }
            },
            {
                name: "games",
                path: "/games",
                component: Juegos,
                meta: {
                    middleware: "all",
                    title: `Juegos`
                }
            },
            {
                name: "game",
                path: '/games/:slug',
                component: Juego,
                meta: {
                    middleware: "all",
                    title: `Juego`
                }
            },
            {
                name: "perfil",
                path: '/perfil/:name',
                component: Perfil,
                meta: {
                    middleware: "auth",
                    title: `Perfil de ${name}`
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
            /* {
                name:"dashboard",
                path: '/',
                component: Dashboard,
                meta:{
                    middleware:"auth",
                    title:`Dashboard`
                }
            }, */
            {
                name: "PageNotFound",
                path: "*",
                component: PageNotFound,
                meta: {
                    middleware: "all",
                    title: `Page Not Found`
                }
            }
        ]
    }
]

var router = new VueRouter({
    mode: 'history',
    routes: Routes
})

router.beforeEach((to, from, next) => {
    document.title = `${to.meta.title} - ${process.env.MIX_APP_NAME}`
    if (to.meta.middleware == "all") {
        next()
    } else if (to.meta.middleware == "guest") {
        if (store.state.auth.authenticated) {
            next({ name: "dashboard" })
        }
        next()
    } else {
        if (store.state.auth.authenticated) {
            next()
        } else {
            next({ name: "login" })
        }
    }
})

export default router