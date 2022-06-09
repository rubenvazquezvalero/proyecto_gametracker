<template>

    <div id="main-content" class="mx-3 mt-4 w-100 bg-white border">
        <nav aria-label="breadcrumb" class="py-2 px-3 border-bottom">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item">
                    <router-link :to="{ name: 'admin' }">Home</router-link>
                </li>
                <li class="breadcrumb-item">
                    <router-link :to="{ name: 'companias' }">Compañias</router-link>
                </li>

                <li class="breadcrumb-item active" aria-current="page">Editar</li>
            </ol>
        </nav>
        <div class="px-3 py-4 d-flex justify-content-between border-bottom">
            <div>
                <h2>Editar Compañia</h2>
            </div>
            <div class="me-3">
                <button class="btn btn-info text-white" @click="submitEditarCompania"><i
                        class="fas fa-user-plus fa-fw pr-2"></i> Editar
                    compañia</button>
            </div>
        </div>
        <form id="game-form" class="m-auto mt-5" action="javascript:void(0)" @submit.prevent="editarCompania"
            method="post">
            <div class="d-md-flex px-4">

                <div class="col-12 col-md-6 pe-2">
                    <div class="form-floating mb-3 mt-4">
                        <input type="text" class="form-control" placeholder="Título" name="name" id="name"
                            v-model="companyData.name">
                        <label for="title">Nombre</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Slug" name="slug" id="slug"
                            v-model="companyData.slug">
                        <label for="title">URL Slug</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Website" name="website" id="website"
                            v-model="companyData.website">
                        <label for="title">Website</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="País" name="country" id="country"
                            v-model="companyData.country">
                        <label for="title">País</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="description" id="description"
                            placeholder="Descripción del juego" rows="6" v-model="companyData.description"></textarea>
                        <label for="description">Descripción</label>
                    </div>

                    <div class="form-floating">
                        <select v-model="companyData.status" class="form-select" id="floatingSelect"
                            aria-label="Floating label select example">
                            <option value="1" selected>Elige una opción</option>
                            <option value="activa">Activa</option>
                            <option value="inactiva">Inactiva</option>
                        </select>
                        <label for="floatingSelect">Estado de la compañia</label>
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
    name: 'companias',
    data() {
        return {
            companyData: {
                name: "",
                slug: "",
                description: "",
                website: "",
                status: "1"
            },
        }
    },
    created() {
        this.cargarCompania()
    },
    methods: {
        async cargarCompania(){
            await axios.get(`/api/companies/${this.$route.params.id}`)
            .then(respuesta => {
                this.companyData = respuesta.data;
            }).catch(error => {
                console.log(error)
            })
        },
        submitEditarCompania() {
            this.$refs.refButton.click();
        },
        async editarCompania() {
            console.log(this.companyData);
            await axios.put(`/api/companies/${this.$route.params.id}`, this.companyData)
                .then(respuesta => {
                    console.log(respuesta.data);
                    if (respuesta.status === 200) {
                        this.$toastr.s(`Compañia ${this.companyData.name} editada`);
                        this.$router.push({ name: 'companias' });
                    }
                })
                .catch(error => {
                    console.log(error);
                    this.$toastr.e("Error al crear la compañia");
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