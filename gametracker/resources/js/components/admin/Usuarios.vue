<template>
    <div id="main-content" class="mx-3 mt-4 w-100 bg-white border">
        <nav aria-label="breadcrumb" class="py-2 px-3 border-bottom">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <router-link :to="{ name: 'admin' }">Home</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
            </ol>
        </nav>
        <div class="px-3 py-4 d-flex justify-content-between border-bottom">
            <div>
                <h2>Usuarios</h2>
            </div>
            <div class="me-3">
                <router-link :to="{ name: 'nuevoJuego' }" class="btn btn-info text-white"><i class="fas fa-user-plus fa-fw pr-2"></i> Añadir
                    usuario</router-link>
            </div>
        </div>
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Fecha de registro</th>
                    <th scope="col">Administrador</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="usuario in usuarios" :key="usuario.id">
                    <th scope="row">{{ usuario.id }}</th>
                    <td class="text-nowrap">{{ usuario.name }}</td>
                    <td class="text-nowrap">{{ usuario.email }}</td>
                    <td class="text-nowrap">{{ usuario.created_at }}</td>
                    <td class="text-nowrap">{{ usuario.is_admin ? 'Si':'No' }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary"><i class="fa-solid fa-pen-to-square fa-fw"></i></button>
                            <button type="button" class="btn btn-danger" @click="deleteGame(usuario)"><i class="fa-solid fa-ban fa-fw"></i></button>
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
    name: 'usuarios',
    data() {
        return {
            usuarios: []
        }
    },
    mounted() {
        this.mostrarUsuarios()
    },
    methods: {
        async mostrarUsuarios() {
            await axios.get('/api/users')
                .then(respuesta => {
                    this.usuarios = respuesta.data
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