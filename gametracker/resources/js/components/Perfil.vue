<template>
    <div>
        <div class="banner">
            <img class="banner-img" :src="`/img/juegos/banners/elden-ring-banner-1.jpg`" alt="" loading="lazy">
        </div>
        <div class="bg-light pb-5">
            <header class="container-fluid container-lg">
                <div class="row">
                    <div class="col cover">
                        <img class="img-fluid" :src="`/img/juegos/portadas/${juego.slug}.png`" :alt="juego.slug" loading="lazy">
                    </div>
                    <div class="col content">
                        <h1 class="game-title text-white fw-bold d-inline-block">{{ juego.title }}</h1>
                        <div class="d-inline-block ms-2">
                            <span v-for="genre in juego.genres" :key="genre.id" class="badge rounded-pill bg-light text-dark ms-1">{{ genre.name }}</span>
                        </div>
                        <div>
                            <span v-for="platform in juego.platforms" :key="platform.id" class="badge rounded-pill bg-dark ms-1">{{ platform.abbreviation }}</span>
                            
                        </div>
                        <p class="mt-4 text-muted">
                            {{ juego.description }}
                        </p>
                    </div>
                </div>
            </header>
        </div>
    </div>
</template>

<script>
import { mapState } from 'vuex';
export default{
    name: "perfil",
    computed: {
        ...mapState(['auth'])
    },
}
</script>

<style scoped>

</style>