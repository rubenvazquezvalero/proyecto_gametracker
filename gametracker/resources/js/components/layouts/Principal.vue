<template>
    <div id="app-web">
        <nav class="navbar navbar-expand-lg navbar-dark position-relative">
            <div class="container">
                <router-link :to="{ name: 'login' }" class="navbar-brand">
                    <img src="/img/logo_gametracker_blanco_sin_borde_125x65.png" alt="" width="85">
                </router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav main-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <!-- <a class="nav-link active" aria-current="page" href="#">Home</a> -->
                            <router-link :to="{ name: 'home' }" class="nav-link">Home</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'games' }" class="nav-link">Juegos</router-link>
                        </li>


                        <li v-if="!auth.authenticated" class="nav-item ms-lg-5">
                            <router-link :to="{ name: 'login' }" class="btn btn-outline-light">Login</router-link>
                        </li>
                        <li v-if="!auth.authenticated" class="nav-item ms-lg-3">
                            <router-link :to="{ name: 'register' }" class="btn btn-success">Regístrate</router-link>
                        </li>
                    </ul>
                    <ul v-if="auth.authenticated" class="navbar-nav user-nav mb-2 mb-lg-0">
                        <li class="nav-item dropdown me-5">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth.user.name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li v-if="auth.user.is_admin">
                                    <router-link :to="{ name:'admin' }" class="dropdown-item">Administración</router-link>
                                </li>
                                <li>
                                    <router-link :to="{ name:'perfil',params:{name:auth.user.name.toLowerCase()}}" class="dropdown-item">Perfil</router-link>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)" @click="logout">Cerrar sesión</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="mt-5">
            <router-view></router-view>
        </main>

        <!-- Footer -->
        <footer class="text-center text-lg-start bg-light text-muted mt-5">

            <!-- Copyright -->
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2022 Copyright:
                <b>GameTrackerDAW.tk</b>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import { mapState } from 'vuex';

export default {
    name: "principal",
    data() {
        return {
            /* user:this.$store.state.auth.user,
            auth:this.$store.state.auth.authenticated */
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
                this.signOut();
                this.$router.push({ name: "login" });
            })
        }
    },
    computed: {
        ...mapState(['auth'])
    }
}
</script>

<!-- Estilos globales -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,900;1,300;1,400&display=swap');

* {
    font-family: 'Roboto', sans-serif;
}

#app-web {
    background-color: #e6f9ee;
    line-height: 1.15;
    overflow: hidden;
}

#app-web main {
	 min-height: calc(100vh - 170px);
	 margin-top: 70px;
}
 #app-web .nav-item .btn {
	 transform: translate(0%, 15%);
}
 #app-web .btn.btn-primary {
	 background-color: #38d67a;
	 border-color: #38d67a;
	/* font-weight: bold;
	 */
}
 #app-web .btn.btn-primary:hover {
	 background-color: #34c972;
	 border-color: #34c972;
}
 #app-web .btn.btn-primary:focus {
	 box-shadow: none;
}
 #app-web .form-control {
	 box-shadow: none;
	 border: none;
	 background-color: #e6f9ee;
}
 #app-web .form-control, #app-web .form-control:focus {
	 box-shadow: 0 0 0 40px #e6f9ee inset;
}

</style>

<!-- Estilos de este componente -->
<style scoped>
@media (min-width: 992px) {
    nav.navbar {
        height: 68px;
        /* padding: 0; */
    }
}
nav.navbar.navbar-dark {
    background-color: #2B4234;
}

.nav-item .nav-link {
    padding: 15px;
}

ul.navbar-nav.main-nav {
    display: inline-flex;
    justify-content: center;
    width: 100%;
    font-size: 1rem;
}

.user-nav {
    min-width: 85px;
    font-size: 1rem;
}
</style>