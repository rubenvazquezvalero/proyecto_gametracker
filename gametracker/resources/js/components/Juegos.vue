<template>

    <div class="container">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-xxl-6 justify-content-start">
            <div v-for="juego in juegos" :key="juego.id" class="col mb-5">
                <div class="card h-100">
                    <!-- Sale badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale
                    </div>
                    <!-- Imagen-->
                    <!-- <img class="card-img-top" src="https://dummyimage.com/450x585/dee2e6/6c757d.jpg" alt="..." /> -->
                    <router-link :to="{name:'game',params:{slug:juego.slug}}">
                        <img class="card-img-top rounded" :src="`/img/juegos/portadas/${juego.slug}.png`" :alt="juego.slug" loading="lazy"/>
                    </router-link>
                    <div class="card-body py-4 px-1">
                        <div class="text-center">
                            <!-- Nombre-->
                            <h5 class="fw-bolder">{{juego.title}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

</template>

<script>
export default{
    name: 'juegos',
    data() {
        return {
            juegos:[]
        }
    },
    mounted() {
        this.mostrarJuegos()
    },
    methods: {
        async mostrarJuegos(){
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
        /* mostrarImagenes(){
            let img = new Image();
            img.loading = 'lazy';
            img.src = 
        } */
    },
}
</script>

<style scoped>
.card{
    background: transparent;
    border: none;
    
}
.card-img-top:hover{
    scale: 1.05;
}
.card-img-top {
    -webkit-box-shadow: 0px 0px 29px 0px rgba(0, 0, 0, 0.4);
    box-shadow: 0px 0px 29px 0px rgba(0, 0, 0, 0.4);
    transition: .15s all ease-in-out;
}
</style>