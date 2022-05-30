<template>
    <div>
        CARGA title: {{juego.title}} slug: {{this.$route.params.slug}}
    </div>
</template>

<script>
export default{
    name: 'juego',
    data() {
        return {
            juego:[]
        }
    },
    mounted() {
        this.mostrarJuego()
    },
    methods: {
        async mostrarJuego(){
            console.log("Página de juego");
            await axios.get(`/api/game-by-slug/${this.$route.params.slug}`)
            .then(respuesta => {
                if(respuesta.data.message != undefined && respuesta.data.message == 'Not found'){
                    console.log("Redireccion 404");
                    this.$router.push({name:'PageNotFound'})
                }
                this.juego = respuesta.data
                console.log(respuesta.data);
            })
            .catch(error => {
                console.log(error)
            })
        },
    },
}
</script>

<style scoped>
.card{
    background: transparent;
    border: none;
}
</style>