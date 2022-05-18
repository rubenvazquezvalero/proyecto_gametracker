import Home from './components/ExampleComponent'

export default {
    mode: 'history',

    //Aquí van las rutas
    routes: [
        {
            name: 'home',
            path: '/',
            component: Home
        }
    ]
};