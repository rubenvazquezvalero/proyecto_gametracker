<template>
    <div id="main-content" class="mx-3 mt-4 w-100 bg-white border">
        <nav aria-label="breadcrumb" class="py-2 px-3 border-bottom">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <router-link :to="{ name: 'admin' }">Home</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Juegos</li>
            </ol>
        </nav>
        <div class="px-3 py-4 d-flex justify-content-between border-bottom">
            <div>
                <h2>Juegos</h2>
            </div>
            <div class="me-3">
                <router-link :to="{ name: 'nuevoJuego' }" class="btn btn-info text-white"><i class="fas fa-user-plus fa-fw pr-2"></i> Añadir
                    juego</router-link>
            </div>
        </div>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Título</th>
                    <th scope="col">Slug</th>
                    <!-- <th scope="col">Descripción</th> -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="juego in juegos" :key="juego.id">
                    <th scope="row">{{ juego.id }}</th>
                    <td class="text-nowrap">{{ juego.title }}</td>
                    <td class="text-nowrap">{{ juego.slug }}</td>
                    <!-- <td>{{ juego.description.substr(0,100)+'...' }}</td> -->
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <router-link :to="{ name:'editarJuego',params:{id:juego.id}}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square fa-fw"></i></router-link>
                            <button type="button" class="btn btn-danger" @click="deleteGame(juego)"><i class="fa-solid fa-ban fa-fw"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
import axios from 'axios'

export default {
    name: 'juegos',
    data() {
        return {
            juegos: []
        }
    },
    mounted() {
        this.mostrarJuegos()
    },
    methods: {
        async mostrarJuegos() {
            await axios.get('/api/game')
                .then(respuesta => {
                    this.juegos = respuesta.data.data
                    /* console.log(respuesta.data); */
                })
                .catch(error => {
                    console.log(error)
                })
        },
        deleteGame(juego){
            let confirmacion = confirm(`¿Quieres eliminar ${juego.title}?`)
            if(confirmacion){
                axios.delete(`/api/game/${juego.id}`)
                .then(respuesta=>{
                    if(respuesta.status == 200){
                        alert(`${juego.title} se ha eliminado.`);
                        juego = null;
                    }
                })
                .catch(error=>{
                    console.log(error);
                })
            }
        }
    },
}
</script>

<style scoped>
</style>