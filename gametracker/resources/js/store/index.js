import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import auth from './auth'

Vue.use(Vuex)

// Vuex permite compartir datos entre todos los componentes, aqui se declara.
export default new Vuex.Store({
    plugins:[
        createPersistedState()
    ],
    modules:{
        auth
    }
})