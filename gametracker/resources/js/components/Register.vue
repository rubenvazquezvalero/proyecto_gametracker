<template>

    <div class="container">
        <div class="register-wrapper rounded p-5 mx-auto text-dark bg-white">
            <div class="register-header text-center">
                <div class="mt-2 mb-3">
                    <img src="/img/logo_gametracker_blanco_sombra2_125x65.png" alt="Logotipo">
                </div>
                <span class="mt-2 text-muted fw-bold">Registro</span>
            </div>
            <form action="javascript:void(0)" @submit.prevent="register" method="POST">
                <div class="form-floating my-4">
                    <input type="text" v-model="user.name" name="name" class="form-control" id="name"
                        placeholder="Nombre" required autofocus>
                    <label for="name">Nombre</label>
                </div>
                <div class="form-floating my-4">
                    <input type="email" v-model="user.email" name="email" class="form-control" id="email"
                        placeholder="Email" required>
                    <label for="email">Email</label>
                </div>
                <div class="form-floating my-4">
                    <input type="password" v-model="user.password" name="password" class="form-control" id="password"
                        placeholder="Password" required>
                    <label for="password">Contraseña</label>
                </div>
                <div class="form-floating my-4">
                    <input type="password" v-model="user.password_confirmation" name="password_confirmation" class="form-control" id="password_confirmation"
                        placeholder="Password confirmation" required>
                    <label for="password_confirmation">Confirmación de contraseña</label>
                </div>
                <div class="d-flex col-12">
                    <button type="submit" :disabled="processing" class="btn btn-primary fw-bold mx-auto">{{ processing ?
                            "Creando cuenta..." : "Crear cuenta"
                    }} <i class="fas fa-sign-in-alt fa-fw"></i></button>
                </div>
            </form>
            <div class="text-center mt-5">
                <span class="text-muted">¿Ya tienes una cuenta?</span>
                <router-link :to="{ name: 'login' }" class="text-muted mx-auto">Login</router-link>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex'
export default {
    name: 'register',
    data() {
        return {
            user: {
                name: "",
                email: "",
                password: "",
                password_confirmation: ""
            },
            processing: false
        }
    },
    methods: {
        ...mapActions({
            signIn: 'auth/login'
        }),
        async register() {
            this.processing = true
            await axios.post('/api/register', this.user).then(response => {
                this.signIn()
            }).catch(({ response: { data } }) => {
                alert(data.message)
            }).finally(() => {
                this.processing = false
            })
        }
    }
}
</script>

<style scoped>
.register-wrapper{
    max-width: 400px;
    width: 100%;
}
.register-header{
    margin-bottom: 40px;
}
.form-floating label {
    line-height: 2;
}
</style>