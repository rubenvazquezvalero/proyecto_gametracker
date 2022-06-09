<template>

    <div class="container">
        <nav class="search mb-4 d-grid">
            <div>
                <label for="title" class="m-0">Búsqueda</label>
                <input type="text" class="rounded border px-2" id="title" v-model="query.title"
                    v-on:keyup="mostrarJuegosFiltro">
            </div>
            <div>
                <label class="typo__label">Géneros</label>
                <multiselect v-model="query.genres" placeholder="Search or add a tag" label="name" track-by="id"
                    :options="genres" :multiple="true" :taggable="false" :limit="1" :selected-Label="'a'"
                    v-on:change="mostrarJuegosFiltro">
                </multiselect>
            </div>
            <div>
                <label class="typo__label">Temas</label>
                <multiselect v-model="query.themes" placeholder="Search or add a tag" label="name" track-by="id"
                    :options="themes" :multiple="true" :taggable="false" :limit="1">
                </multiselect>
            </div>
            <div>
                <label class="typo__label">Plataformas</label>
                <multiselect v-model="query.platforms" placeholder="Search or add a tag" label="name" track-by="id"
                    :options="platforms" :multiple="true" :taggable="false" :limit="1">
                </multiselect>
            </div>
            <div>
                <label class="typo__label">Modos de juego</label>
                <multiselect v-model="query.modes" placeholder="Search or add a tag" label="name" track-by="id"
                    :options="modes" :multiple="true" :taggable="false" :limit="1">
                </multiselect>
            </div>
        </nav>
        <div
            class="row gx-4 gx-lg-5 row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-xxl-6 justify-content-start">
            <div v-for="juego in juegos" :key="juego.id" class="col">
                <div class="card h-100">
                    <!-- Sale badge-->
                    <!-- <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale
                    </div> -->
                    <!-- Imagen-->
                    <!-- <img class="card-img-top" src="https://dummyimage.com/450x585/dee2e6/6c757d.jpg" alt="..." /> -->
                    <router-link :to="{ name: 'game', params: { slug: juego.slug } }">
                        <img class="card-img-top rounded" :src="`/img/juegos/portadas/${juego.slug}.png`" @error="$event.target.src=`https://via.placeholder.com/264x352.png?text=${juego.title}`" :alt="juego.slug" loading="lazy" />
                    </router-link>
                    <div class="card-body py-4 px-1">
                        <div class="text-center">
                            <!-- Nombre-->
                            <h5 class="fw-bolder">{{ juego.title }}</h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</template>

<script>
export default {
    name: 'juegos',
    data() {
        return {
            juegos: [],
            query: {
                title: "",
                genres: null,
                themes: null,
                platforms: null,
                year: "",
                developers: null,
                publishers: null,
                modes: null
            },
            genres: [],
            themes: [],
            platforms: [],
            modes: []
        }
    },
    created() {
        this.loadGenres(),
            this.loadThemes(),
            this.loadPlatforms(),
            this.loadGameModes()
    },
    mounted() {
        this.mostrarJuegos()
    },
    methods: {
        async mostrarJuegos() {
            await axios.get('/api/game')
                .then(respuesta => {
                    this.juegos = respuesta.data.data
                    console.log(respuesta.data);
                    //this.mostrarImagenes();
                })
                .catch(error => {
                    console.log(error)
                })
        },
        async mostrarJuegosFiltro() {
            await axios.post('/api/game/filtro', this.query)
                .then(respuesta => {
                    this.juegos = respuesta.data.data
                    console.log(respuesta.data);
                    //this.mostrarImagenes();
                })
                .catch(error => {
                    console.log(error)
                })
        },
        /* mostrarImagenes(){
            let img = new Image();
            img.loading = 'lazy';
            img.src = 
        } */
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
    },
    watch: {
        'query.genres': 'mostrarJuegosFiltro'
    }

}
</script>

<style scoped>
.search {
    grid-gap: 24px;
    grid-template-columns: repeat(6, 180px);
}

.search #title {
    height: 40px;
    width: 100%;
}


.card {
    background: transparent;
    border: none;

}

.card-img-top:hover {
    scale: 1.05;
}

.card-img-top {
    -webkit-box-shadow: 0px 14px 30px rgba(0, 0, 0, 0.4);
    box-shadow: 0px 14px 30px rgba(0, 0, 0, 0.4);
    transition: .15s all ease-in-out;
}

@media (min-width: 992px) {
    #searchFilters {
        display: grid;
        grid-gap: 24px;
        grid-template-columns: repeat(6, 180px);
    }
}
</style>