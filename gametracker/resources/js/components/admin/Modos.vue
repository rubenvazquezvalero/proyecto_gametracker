<template>
    <div id="main-content" class="mx-3 mt-4 w-100 bg-white border">
        <nav aria-label="breadcrumb" class="py-2 px-3 border-bottom">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <router-link :to="{ name: 'admin' }">Home</router-link>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Modos</li>
            </ol>
        </nav>
        <div class="px-3 py-4 d-flex justify-content-between border-bottom">
            <div>
                <h2>Modos de juego</h2>
            </div>
            <div class="me-3">
                <router-link :to="{ name: 'nuevoJuego' }" class="btn btn-info text-white"><i
                        class="fas fa-user-plus fa-fw pr-2"></i> Añadir
                    modo</router-link>
            </div>
        </div>
        <pagination :totalPages="this.pages.last" :currentPage="this.pages.current" :perPage="10"
            @pagechanged="onPageChange" />
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">URL Slug</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="mode in modes" :key="mode.id">
                    <th scope="row">{{ mode.id }}</th>
                    <td class="text-nowrap">{{ mode.name }}</td>
                    <td class="text-nowrap">{{ mode.slug }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary"><i
                                    class="fa-solid fa-pen-to-square fa-fw"></i></button>
                            <button type="button" class="btn btn-danger" @click="deleteGame(usuario)"><i
                                    class="fa-solid fa-ban fa-fw"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
import Pagination from './Paginacion.vue'
import axios from 'axios'

export default {
    name: 'companias',
    components: {
        Pagination
    },
    data() {
        return {
            modes: [],
            pages: {
                current: 0,
                first_url: '',
                next_url: '',
                prev_url: '',
                last: 0,
                last_url: ''
            }
        }
    },
    mounted() {
        this.mostrarUsuarios()
    },
    methods: {
        async mostrarUsuarios() {
            await axios.get('/api/modes/paginate')
                .then(respuesta => {
                    this.modes = respuesta.data.data;

                    this.pages.current = respuesta.data.current_page;
                    this.pages.next = respuesta.data.next_page_url;
                    this.pages.prev = respuesta.data.prev_page_url;
                    this.pages.first_url = respuesta.data.first_page_url;
                    this.pages.last = respuesta.data.last_page;
                    this.pages.last_url = respuesta.data.last_page_url;

                    console.log(respuesta.data);
                })
                .catch(error => {
                    console.log(error)
                })
        },
        onPageChange(page) {
            console.log(page)
            this.pages.current = page;
            axios.get(`/api/modes/paginate/?page=${page}`)
            .then(respuesta=>{
                this.modes = respuesta.data.data;
            })
        }
    },
}
</script>

<style scoped>
</style>