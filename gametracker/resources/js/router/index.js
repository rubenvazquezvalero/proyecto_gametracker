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
//import DahboardLayout from '../components/layouts/Dashboard.vue';
/* Layouts */

/* Authenticated Component */
//import Dashboard from '../components/Dashboard.vue';
/* Authenticated Component */

import Juegos from '../components/Juegos.vue';
import Juego from '../components/Juego.vue';
import Perfil from '../components/Perfil.vue';
/* Admin */
import IndexAdmin from '../components/admin/Index.vue';
import Usuarios from '../components/admin/Usuarios.vue';
import Plataformas from '../components/admin/Plataformas.vue';
import Companias from '../components/admin/Companias.vue';
import Modos from '../components/admin/Modos.vue';
import JuegosAdmin from '../components/admin/Juegos.vue';

import NuevoJuego from '../components/admin/NuevoJuego.vue';
import EditarJuego from '../components/admin/EditarJuego.vue';
import NuevaCompania from '../components/admin/NuevaCompania.vue';
import EditarCompania from '../components/admin/EditarCompania.vue';

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
                name: 'usuarios',
                path: "/admin/usuarios",
                component:  Usuarios,
                meta: {
                    middleware: "auth",
                    title: `Administración Usuarios`
                }
            },
            {
                name: 'juegosAdmin',
                path: "/admin/juegos",
                component:  JuegosAdmin,
                meta: {
                    middleware: "auth",
                    title: `Administración Juegos`
                }
            },
            {
                name: 'nuevoJuego',
                path: "/admin/juegos/nuevo",
                component:  NuevoJuego,
                meta: {
                    middleware: "auth",
                    title: `Administración | Crear juego`
                }
            },
            {
                name: 'editarJuego',
                path: "/admin/juegos/editar/:id",
                component:  EditarJuego,
                meta: {
                    middleware: "auth",
                    title: `Administración | Editar juego`
                }
            },
            {
                name: 'plataformas',
                path: "/admin/plataformas",
                component:  Plataformas,
                meta: {
                    middleware: "auth",
                    title: `Administración Plataformas`
                }
            },
            {
                name: 'companias',
                path: "/admin/companias",
                component:  Companias,
                meta: {
                    middleware: "auth",
                    title: `Administración Compañias`
                }
            },
            {
                name: 'nuevaCompania',
                path: "/admin/companias/nueva",
                component:  NuevaCompania,
                meta: {
                    middleware: "auth",
                    title: `Administración | Crear compañia`
                }
            },
            {
                name: 'editarCompania',
                path: "/admin/companias/editar/:id",
                component:  EditarCompania,
                meta: {
                    middleware: "auth",
                    title: `Administración | Editar compañia`
                }
            },
            {
                name: 'modos',
                path: "/admin/modos",
                component:  Modos,
                meta: {
                    middleware: "auth",
                    title: `Administración Modos de Juego`
                }
            },
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
                name: "home",
                path: "/",
                component: Juegos,
                meta: {
                    middleware: "all",
                    title: `Juegos`
                }
            },
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