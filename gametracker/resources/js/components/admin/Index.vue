<template>
    <div id="app-admin" class="bg-light">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary px-5">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><i class="fa-solid fa-screwdriver-wrench fa-fw"></i> Gestión |
                    {{ app_name }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth.user.name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="javascript:void(0)" @click="logout">Cerrar sesión</a>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="d-flex">
            <aside class="bg-dark pt-4">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Juegos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Plataformas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Temáticas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Compañias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Géneros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Modos de juego</a>
                    </li>
                </ul>
            </aside>
            <router-view></router-view>
        </main>
    </div>


</template>

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
    width: 240px;
    min-height: calc(100vh - 56px);
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
</style>