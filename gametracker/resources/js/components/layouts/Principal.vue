<template>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark">
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
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <router-link :to="{ name: 'games' }" class="nav-link">Juegos</router-link>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
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
                                <li><a class="dropdown-item" href="javascript:void(0)" @click="logout">Cerrar sesión</a>
                                </li>
                                <li>
                                    <router-link :to="{ name:'perfil',params:{name:auth.user.name}}" class="dropdown-item">Perfil</router-link>
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
            <!-- Section: Social media -->
            <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                <!-- Left -->
                <div class="me-5 d-none d-lg-block">
                    <span>Get connected with us on social networks:</span>
                </div>
                <!-- Left -->

                <!-- Right -->
                <div>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
                <!-- Right -->
            </section>
            <!-- Section: Social media -->

            <!-- Section: Links  -->
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Content -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                <i class="fas fa-gem me-3"></i>Company name
                            </h6>
                            <p>
                                Here you can use rows and columns to organize your footer content. Lorem ipsum
                                dolor sit amet, consectetur adipisicing elit.
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Products
                            </h6>
                            <p>
                                <a href="#!" class="text-reset">Angular</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">React</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Vue</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Laravel</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Useful links
                            </h6>
                            <p>
                                <a href="#!" class="text-reset">Pricing</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Settings</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Orders</a>
                            </p>
                            <p>
                                <a href="#!" class="text-reset">Help</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                            <!-- Links -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                Contact
                            </h6>
                            <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                            <p>
                                <i class="fas fa-envelope me-3"></i>
                                info@example.com
                            </p>
                            <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                            <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
            </section>
            <!-- Section: Links  -->

            <!-- Copyright -->
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2021 Copyright:
                <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
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
    },
}
</script>

<!-- Estilos globales -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,900;1,300;1,400&display=swap');

* {
    font-family: 'Roboto', sans-serif;
}

body {
    background-color: #e6f9ee;
    line-height: 1.15;
}

main {
    min-height: calc(100vh - 170px);
    margin-top: 70px;
}

.nav-item .btn {
    transform: translate(0%, 15%);
}

.btn.btn-primary {
    background-color: #38D67A;
    border-color: #38D67A;
    font-weight: bold;
}

.btn.btn-primary:hover {
    background-color: #34C972;
    border-color: #34C972;
}

.btn.btn-primary:focus {
    box-shadow: none;
}

.form-control {
    box-shadow: none;
    border: none;
    background-color: #e6f9ee;
}

.form-control,
.form-control:focus {
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
}
</style>