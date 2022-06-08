<template>

    <div id="main-content" class="mx-3 mt-4 w-100 bg-white border">
        <nav aria-label="breadcrumb" class="py-2 px-3 border-bottom">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <router-link :to="{ name: 'admin' }">Home</router-link>
                </li>
                <li class="breadcrumb-item">
                    <router-link :to="{ name: 'juegosAdmin' }">Juegos</router-link>
                </li>

                <li class="breadcrumb-item active" aria-current="page">Nuevo</li>
            </ol>
        </nav>
        <div class="px-3 py-4 d-flex justify-content-between border-bottom">
            <div>
                <h2>Juegos</h2>
            </div>
            <div class="me-3">
                <button class="btn btn-info text-white" @click="submitCrearJuego"><i
                        class="fas fa-user-plus fa-fw pr-2"></i> Añadir
                    juego</button>
            </div>
        </div>
        <form id="game-form" class="m-auto mt-5" action="javascript:void(0)" @submit.prevent="crearJuego" method="post">
            <div class="d-md-flex px-4">

                <div class="col-12 col-md-6 pe-2">
                    <div class="form-floating mb-3 mt-4">
                        <input type="text" class="form-control" placeholder="Título" name="title" id="title"
                            v-model="gameData.title">
                        <label for="title">Título</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Slug" name="slug" id="slug"
                            v-model="gameData.slug">
                        <label for="title">URL Slug</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="description" id="description"
                            placeholder="Descripción del juego" rows="6" v-model="gameData.description"></textarea>
                        <label for="description">Descripción</label>
                    </div>
                    <!-- Multiselect gameModes -->
                    <div class="mb-3">
                        <label class="typo__label">Modos de juego</label>
                        <multiselect v-model="gameData.modes" tag-placeholder="Add this as new tag"
                            placeholder="Search or add a tag" label="name" track-by="id" :options="modes"
                            :multiple="true" :taggable="false">
                        </multiselect>
                    </div>
                </div>
                <div class="col-12 col-md-6 ps-2">
                    <!-- Multiselect genres -->
                    <div class="mb-3">
                        <label class="typo__label">Géneros</label>
                        <multiselect v-model="gameData.genres" tag-placeholder="Add this as new tag"
                            placeholder="Search or add a tag" label="name" track-by="id" :options="genres"
                            :multiple="true" :taggable="false">
                        </multiselect>
                    </div>
                    <!-- Multiselect themes -->
                    <div class="mb-3">
                        <label class="typo__label">Temáticas</label>
                        <multiselect v-model="gameData.themes" tag-placeholder="Add this as new tag"
                            placeholder="Search or add a tag" label="name" track-by="id" :options="themes"
                            :multiple="true" :taggable="false">
                        </multiselect>
                    </div>
                    <!-- Multiselect platforms -->
                    <div class="mb-3">
                        <label class="typo__label">Plataformas</label>
                        <multiselect v-model="gameData.platforms" tag-placeholder="Add this as new tag"
                            placeholder="Search or add a tag" label="name" track-by="id" :options="platforms"
                            :multiple="true" :taggable="false">
                        </multiselect>
                    </div>
                    <label class="mb-3">Fechas de salida</label>
                    <div class="mb-3" v-for="item in gameData.platforms">
                        <label :for="item.slug">{{ item.name }}</label>
                        <input :id="item.slug" v-model="item.release_date" type="date" />
                    </div>
                    <!-- Multiselect developers -->
                    <div class="mb-3">
                        <label class="typo__label">Desarrolladores</label>
                        <multiselect v-model="gameData.developers" tag-placeholder="Add this as new tag"
                            placeholder="Search or add a tag" label="name" track-by="id" :options="companies"
                            :multiple="true" :taggable="false">
                        </multiselect>
                    </div>
                    <!-- Multiselect publishers -->
                    <div class="mb-3">
                        <label class="typo__label">Editores</label>
                        <multiselect v-model="gameData.publishers" tag-placeholder="Add this as new tag"
                            placeholder="Search or add a tag" label="name" track-by="id" :options="companies"
                            :multiple="true" :taggable="false">
                        </multiselect>
                    </div>
                </div>
            </div>

            <button ref="refButton" type="submit" class="d-none"></button>

        </form>

    </div>

</template>

<script>
import axios from 'axios'

export default {
    name: 'juegos',
    data() {
        return {
            gameData: {
                title: "",
                slug: "",
                description: "",
                developers: null,
                publishers: null,
                genres: null,
                themes: null,
                platforms: null,
                modes: null
            },
            companies: [],
            platforms: [],
            genres: [],
            themes: [],
            modes: []
        }
    },
    created() {
        this.loadCompanies(),
            this.loadPlatforms(),
            this.loadGenres(),
            this.loadThemes(),
            this.loadGameModes()
    },
    methods: {
        async loadCompanies() {
            await axios.get('/api/companies/name')
                .then(respuesta => {
                    this.companies = respuesta.data
                    /* console.log(respuesta.data); */
                })
                .catch(error => {
                    console.log(error)
                })
        },
        async loadPlatforms() {
            await axios.get('/api/platforms')
                .then(respuesta => {
                    this.platforms = respuesta.data
                    /* console.log(respuesta.data); */
                })
                .catch(error => {
                    console.log(error)
                })
        },
        async loadGenres() {
            await axios.get('/api/genres')
                .then(respuesta => {
                    this.genres = respuesta.data
                    /* console.log(respuesta.data); */
                })
                .catch(error => {
                    console.log(error)
                })
        },
        async loadThemes() {
            await axios.get('/api/themes')
                .then(respuesta => {
                    this.themes = respuesta.data
                    /* console.log(respuesta.data); */
                })
                .catch(error => {
                    console.log(error)
                })
        },
        async loadGameModes() {
            await axios.get('/api/modes')
                .then(respuesta => {
                    this.modes = respuesta.data
                    /* console.log(respuesta.data); */
                })
                .catch(error => {
                    console.log(error)
                })
        },
        submitCrearJuego() {
            this.$refs.refButton.click();
        },
        async crearJuego() {
            console.log(this.gameData);
            await axios.post('/api/game', this.gameData)
                .then(respuesta => {
                    console.log(respuesta.data);
                    if (respuesta.status === 200) {
                        this.$toastr.s(`Juego "${this.gameData.title}" creado`);
                    }
                })
                .catch(error => {
                    console.log(error);
                    this.$toastr.e("Error la crear el juego");
                })
        }
    },
}
</script>

<style>
.multiselect__tags .multiselect__placeholder {
    margin: 0;
}
</style>

<style scoped>
textarea.form-control {
    height: 200px;
}
</style>