<template>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <router-link :to="{name:'login'}" class="navbar-brand">
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
                            <a class="nav-link" href="#">Link</a>
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
                    </ul>
                    <ul class="navbar-nav user-nav mb-2 mb-lg-0">
                        <li v-show="$store.state.auth.authenticated" class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $store.state.auth.user.name }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="javascript:void(0)" @click="logout">Cerrar sesión</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
import {mapActions} from 'vuex';
export default{
    name:"principal",
    data(){
        return {
            user:this.$store.state.auth.user,
            auth:this.$store.state.auth.authenticated
        }
    },
    methods:{
        ...mapActions({
            signOut:"auth/logout"
        }),
        async logout(){
            await axios.get('/api/logout').then(({data})=>{
                this.signOut();
                this.$router.push({name:"login"});
            }).catch((error) => {
                console.log(error.response.data.errors);
                this.signOut();
                this.$router.push({name:"login"});
            })
        }
    }
}
</script>

<style>
body {
    background-color: #e6f9ee;
    line-height: 1.15;
}
</style>

<style scoped>
nav.navbar {
    height: 68px;
    padding: 0;
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