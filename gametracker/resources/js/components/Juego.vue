<template>
    <div>
        <div class="game-banner">
            <img class="game-banner-img" :src="`/img/juegos/banners/${juego.slug}-banner-1.jpg`" alt="" loading="lazy">
        </div>
        <div class="bg-light pb-5">
            <header class="container-fluid container-lg">
                <div class="row">
                    <div class="col cover">
                        <div class="cover-content">
                            <!-- Portada del juego -->
                            <img class="img-fluid" :src="`/img/juegos/portadas/${juego.slug}.png`" @error="$event.target.src=`https://via.placeholder.com/264x352.png?text=${juego.title}`" :alt="juego.slug"
                                loading="lazy">
                            <!-- Boton añadir a la lista -->
                            <div class="dropdown d-block">
                                <button class="btn btn-primary dropdown-toggle w-100 rounded-0" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Añadir a la lista
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark"
                                    aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="javascript:void(0)"
                                            @click="addGameToList('pendiente')">Pendiente</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0)"
                                            @click="addGameToList('jugando')">Jugando</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0)"
                                            @click="addGameToList('terminado')">Terminado</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col content">
                        <h1 class="game-title text-white fw-bold d-inline-block">{{ juego.title }}</h1>
                        <div class="d-inline-block ms-2">
                            <span v-for="genre in juego.genres" :key="genre.id"
                                class="badge rounded-pill bg-light text-dark ms-1">{{ genre.name }}</span>
                        </div>
                        <div>
                            <span v-for="platform in juego.platforms" :key="platform.id"
                                class="badge rounded-pill bg-dark ms-1">{{ platform.abbreviation }}</span>

                        </div>
                        <p class="mt-4 text-muted">
                            {{ juego.description }}
                        </p>
                    </div>
                </div>
            </header>
        </div>
        <div class="container-fluid container-lg pt-4 info">
            <div class="row">
                <h2 class="fs-5 .title-info text-uppercase fw-bolder">Información</h2>
                <hr>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl">
                    <!-- Fecha de salida en cada plataforma -->
                    <span class="fw-bold">Fechas de salida:</span>
                    <span v-for="platform in juego.platforms" :key="platform.id" class="text-info text-muted d-block">{{
                            platform.pivot.release_date
                    }} - {{ platform.name }}</span>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl">
                    <!-- Lista de desarrolladores -->
                    <span class="fw-bold">Desarrolladores:</span>
                    <span v-for="developer in juego.developers" :key="developer.id"
                        class="text-info text-muted d-block">{{ developer.name }}</span>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl">
                    <span class="fw-bold">Editores:</span>
                    <span v-for="publisher in juego.publishers" :key="publisher.id"
                        class="text-info text-muted d-block">{{ publisher.name }}</span>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl">
                    <span class="fw-bold">Temática:</span>
                    <span v-for="theme in juego.themes" :key="theme.id" class="text-info text-muted d-block">{{
                            theme.name
                    }}</span>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl">
                    <span class="fw-bold">Modos de juego:</span>
                    <span v-for="game_mode in juego.game_modes" :key="game_mode.id"
                        class="text-info text-muted d-block">{{ game_mode.name }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'juego',
    data() {
        return {
            juego: []
        }
    },
    created() {
        this.mostrarJuego()
    },
    mounted() {

    },
    methods: {
        async mostrarJuego() {
            console.log("Página de juego");
            await axios.get(`/api/game-by-slug/${this.$route.params.slug}`)
                .then(respuesta => {
                    if (respuesta.data.message != undefined && respuesta.data.message == 'Not found') {
                        console.log("Redireccion 404");
                        this.$router.push({ name: 'PageNotFound' })
                    }
                    this.juego = respuesta.data
                    console.log(respuesta.data);
                })
                .catch(error => {
                    console.log(error)
                })
        },
        async addGameToList(status) {
            console.log(status);
            await axios.post('/api/list/add-game', {
                game_id: this.juego.id,
                status: status
            }).then(response => {
                console.log(response)
            }).catch(error => {
                this.$toastr.e(error);
                //window.alert(error);
                console.log(error);
            });
        },
        /* async addPlaying() {
            await axios.post('/api/list/add-game', {
                game_id: this.juego.id,
                status: 'Jugando'
            }).then(response => {
                console.log(response)
            }).catch(error => {
                console.log(error);
            });
        },
        async addFinished() {
            await axios.post('/api/list/add-game', {
                game_id: this.juego.id,
                status: 'Terminado'
            }).then(response => {
                console.log(response)
            }).catch(error => {
                console.log(error);
            });
        } */
    },
}
</script>

<style scoped>
.cover {
    margin-top: -66px;
    max-width: 124px;
    position: relative;
}

.cover .cover-content {
    -webkit-box-shadow: 0px 0px 29px 0px rgba(0, 0, 0, 0.4);
    box-shadow: 0px 0px 29px 0px rgba(0, 0, 0, 0.4);
}

.game-banner {
    position: relative;
    height: 200px;
    overflow: hidden;
    margin-top: -48px;
}

.game-banner::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(180deg, rgba(0, 0, 0, 0) 40%, rgba(0, 0, 0, .6));
}

.game-banner-img {
    height: 100%;
}

.game-title {
    line-height: 48px;
}

.content {
    margin-top: -50px;
    position: relative;
}

.info {
    padding-bottom: 48px;
}

.info .col span.text-info {
    font-size: .8em;
}

@media (min-width: 767.98px) {
    .cover {
        margin-top: -176px;
        max-width: 288px;
    }

    .game-banner {
        height: 400px;
    }
}
</style>