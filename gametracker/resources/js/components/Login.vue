<template>
    <!-- <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="card shadow sm">
                    <div class="card-body">
                        <h1 class="text-center">Login</h1>
                        <hr/>
                        <form action="javascript:void(0)" class="row" method="post">
                            <div class="form-group col-12">
                                <label for="email" class="font-weight-bold">Email</label>
                                <input type="text" v-model="auth.email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label for="password" class="font-weight-bold">Password</label>
                                <input type="password" v-model="auth.password" name="password" id="password" class="form-control">
                            </div>
                            <div class="col-12 mb-2">
                                <button type="submit" :disabled="processing" @click="login" class="btn btn-primary btn-block">
                                    {{ processing ? "Please wait" : "Login" }}
                                </button>
                            </div>
                            <div class="col-12 text-center">
                                <label>Don't have an account? <router-link :to="{name:'register'}">Register Now!</router-link></label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="container">
        <div class="login-wrapper rounded p-5 mx-auto text-dark bg-white">
            <div class="login-header text-center">
                <div class="mt-2 mb-3">
                    <img src="/img/logo_gametracker_blanco_sombra2_125x65.png" alt="Logotipo">
                </div>
                <span class="mt-2 text-muted fw-bold">Iniciar sesión</span>
            </div>
            <form action="javascript:void(0)" method="POST">
                <div class="form-floating my-4">
                    <input type="email" v-model="auth.email" name="email" class="form-control" id="email"  placeholder="Email" required autocomplete="email" autofocus>
                    <label for="email">Email</label>
                </div>
                <div class="form-floating my-4">
                    <input type="password" v-model="auth.password" name="password" class="form-control" id="password" placeholder="Password"
                        required autocomplete="current-password">
                    <label for="password">Contraseña</label>
                </div>
                <div class="d-flex col-12">
                    <button type="submit" :disabled="processing" @click="login" class="btn btn-primary mx-auto">{{ processing ? "Iniciando sesión" : "Inicia sesión" }} <i
                            class="fas fa-sign-in-alt fa-fw"></i></button>
                </div>
            </form>
            <div class="text-center mt-5">
                <span class="text-muted">¿Aún no tienes cuenta?</span>
                <router-link :to="{name:'register'}" class="text-muted mx-auto">Registrate</router-link>
                <!-- <router-link :to="{name:'register'}" class="btn btn-danger mx-auto my-3">Crear cuenta <i
                        class="fas fa-user-plus fa-fw"></i></router-link> -->
            </div>
        </div>
    </div>
</template>

<script>
//Importamos actions de la store
import { mapActions } from 'vuex';
export default {
    name:"login",
    data(){
        return {
            auth:{
                email:"",
                password:""
            },
            processing:false
        }
    },
    methods:{
        ...mapActions({
            signIn:'auth/login'
        }),
        async login(){
            this.processing = true
            await axios.get('/sanctum/csrf-cookie')
            await axios.post('/api/login',this.auth).then(({data})=>{
                this.signIn()
            }).catch(({response:{data}})=>{
                alert(data.message)
            }).finally(()=>{
                this.processing = false
            })
        },
    }
}
</script>

<style scoped>
.login-wrapper{
    max-width: 400px;
    width: 100%;
}
.login-header{
    margin-bottom: 40px;
}
.form-floating label {
    line-height: 2;
}
</style>