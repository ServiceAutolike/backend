require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router'
import { routes }  from './routerPage';
Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes,
    scrollBehavior (to, from, savedPosition) {
        var body = $("html, body");
        body.stop().animate({scrollTop:0}, 700, 'swing');
        //return { x: 0, y: 0 }
    }
})


const app = new Vue({
    el: '#app',
    router,
});
