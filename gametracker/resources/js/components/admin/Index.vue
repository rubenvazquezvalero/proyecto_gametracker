<template>
    <div id="app-admin" class="bg-light">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-lg-5">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><i class="fa-solid fa-screwdriver-wrench fa-fw"></i> Gestión |
                    {{ app_name }}</a>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth.user.name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="javascript:void(0)" @click="logout">Cerrar sesión</a>
                        </ul>
                    </li>
                </ul>
                <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#asideMenu"
                    aria-controls="asideMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <main class="d-flex overflow-hidden ">
            <aside id="asideMenu" class="bg-dark pt-4 collapse d-lg-block">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <!-- <a class="nav-link" aria-current="page" href="#">Home</a> -->
                        <router-link :to="{ name: 'admin' }" class="nav-link"><i class="fa-solid fa-house fa-fw"></i> Home</router-link>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="#">Usuarios</a> -->
                        <router-link :to="{ name: 'usuarios' }" class="nav-link"><i class="fa-solid fa-users fa-fw"></i> Usuarios</router-link>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="#">Juegos</a> -->
                        <router-link :to="{ name: 'juegosAdmin' }" class="nav-link"><i class="fa-solid fa-gamepad fa-fw"></i> Juegos</router-link>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="#"><i class="fa-solid fa-circle-right fa-fw"></i> Plataformas</a> -->
                        <router-link :to="{ name: 'plataformas' }" class="nav-link"><i class="fa-solid fa-circle-right fa-fw"></i> Plataformas</router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-circle-right fa-fw"></i> Temas</a>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="#"><i class="fa-solid fa-building fa-fw"></i> Compañias</a> -->
                        <router-link :to="{ name: 'companias' }" class="nav-link"><i class="fa-solid fa-building fa-fw"></i> Compañias</router-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-circle-right fa-fw"></i> Géneros</a>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link" href="#"><i class="fa-solid fa-circle-right fa-fw"></i> Modos de juego</a> -->
                        <router-link :to="{ name: 'modos' }" class="nav-link"><i class="fa-solid fa-circle-right fa-fw"></i> Modos de juego</router-link>
                    </li>
                    <hr>
                    <li class="nav-item">
                        <router-link :to="{ name: 'games' }" class="nav-link"><i class="fa-solid fa-reply fa-fw"></i> Volver a la web</router-link>
                    </li>
                </ul>
            </aside>
            <router-view></router-view>
        </main>
    </div>

</template>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<script>
import { mapActions } from 'vuex';
import { mapState } from 'vuex';

export default {
    name: "principal",
    data() {
        return {
            app_name: process.env.MIX_APP_NAME
        }
    },
    methods: {
        ...mapActions({
            signOut: "auth/logout"
        }),
        async logout() {
            await axios.get('/api/logout').then(({ data }) => {
                this.signOut();
                this.$router.push({ name: "login" });
            }).catch((error) => {
                console.log(error.response.data.errors);
                /* this.signOut(); */
                this.$router.push({ name: "login" });
            })
        }
    },
    computed: {
        ...mapState(['auth'])
    }
}
</script>

<style>
nav.navbar {
    position: relative;
    -webkit-box-shadow: 0px 0px 5px 1px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 0px 5px 1px rgba(0, 0, 0, 0.3);
}

#app-admin {
    min-height: 100vh;
}
</style>

<style scoped>
aside {
    width: 100%;
    flex-shrink: 0;
}

aside .nav-item a {
    color: #e0e0e0;
    transition: all .2s ease;
}

aside .nav-item:hover a {
    /* color: #343a40; */
    color: #fff;
    /* background-color: #e0e0e0; */
    background-color: rgba(0, 0, 0, .2);
}

main {
    min-height: calc(100vh - 56px);
    display: flex;
}

.navbar-nav .dropdown-menu{
    position: absolute;
}

@media (min-width: 992px) {
    aside {
        width: 240px;
        min-height: calc(100vh - 56px);
        flex-shrink: 0;
    }
}
</style>