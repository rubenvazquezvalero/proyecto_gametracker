<template>
    <div>
        <div class="banner">
            <img class="banner-img" src="/img/juegos/banners/elden-ring-banner-1.jpg" alt="">
        </div>
        <div class="bg-light pb-5">
            <header class="container-fluid container-lg">
                <div class="row">
                    <div class="col user-img">
                        <img class="img-fluid rounded-circle" src="/img/perfiles/default/portrait_default.png" alt="">
                    </div>
                    <div class="col content">
                        <h1 class="title text-white fw-bold d-inline-block">{{ auth.user.name }}</h1>
                        <div v-if="auth.user.is_admin">
                            <span class="badge rounded-pill bg-dark">Admin</span>
                        </div>
                        <!-- <p class="mt-4 text-muted">
                        Descripcion
                    </p> -->
                    </div>
                </div>
            </header>
        </div>
        <div class="container-fluid container-lg pt-4 info">
            <div class="games-table row bg-light rounded p-4">
                <h2 class="fs-5 .title-info text-uppercase fw-bolder">Lista de juegos</h2>
                <hr>
                <div class="col-12">
                    <table class="table table-striped">
                        <tbody>
                            <tr v-for="juego in lista.games" v-bind:key="juego.id">
                                <td>
                                    <img :src="`/img/juegos/portadas/${juego.slug}.png`" alt="" height="100">
                                </td>
                                <td>{{ juego.title }}</td>
                                <td>
                                    <div>
                                        <div class="btn btn-sm" v-bind:class="[juego.pivot.status == 'pendiente' ? 'btn-success': 'btn-secondary']">
                                            <i class="fas fa-clock fa-fw"></i>
                                            <div>Pendiente</div>
                                        </div>
                                        <div class="btn btn-sm" v-bind:class="[juego.pivot.status == 'jugando' ? 'btn-success': 'btn-secondary']">
                                            <i class="fas fa-gamepad fa-fw"></i>
                                            <div>Jugando</div>
                                        </div>
                                        <div class="btn btn-sm" v-bind:class="[juego.pivot.status == 'terminado' ? 'btn-success': 'btn-secondary']">
                                            <i class="fas fa-check-circle fa-fw"></i>
                                            <div>Terminado</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';
export default {
    name: "perfil",
    data() {
        return {
            lista: []
        }
    },
    computed: {
        ...mapState(['auth'])
    },
    created() {
        this.mostrarLista()
    },
    methods: {
        async mostrarLista(){
            await axios.get(`/api/list/${this.auth.user.id}`)
            .then(respuesta => {
                this.lista = respuesta.data
                console.log(respuesta.data);
                //this.mostrarImagenes();
            })
            .catch(error => {
                console.log(error)
            })
        },
    },
}
</script>

<style scoped>
.user-img {
    margin-top: -66px;
    max-width: 100px;
    position: relative;
}

.user-img img {
    -webkit-box-shadow: 0px 0px 29px 0px rgba(0, 0, 0, 0.4);
    box-shadow: 0px 0px 29px 0px rgba(0, 0, 0, 0.4);
}

.banner {
    position: relative;
    height: 200px;
    overflow: hidden;
    margin-top: -48px;
}

.banner::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(180deg, rgba(0, 0, 0, 0) 40%, rgba(0, 0, 0, .6));
}

.banner-img {
    height: 100%;
}

.title {
    line-height: 48px;
}

.content {
    margin-top: -50px;
    position: relative;
}

.info .col span.text-info {
    font-size: .8em;
}

.games-table {
    /* -webkit-box-shadow: 0px 0px 29px 0px rgba(0, 0, 0, 0.1);
            box-shadow: 0px 0px 29px 0px rgba(0, 0, 0, 0.1); */
}

@media (min-width: 767.98px) {
    .user-img {
        margin-top: -100px;
        max-width: 174px;
    }

    .banner {
        height: 400px;
    }
}
</style>