require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router'
import { routes }  from './routerPage';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(ElementUI);
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

Vue.component('Modal', require('./components/Modal.vue').default);
Vue.component('LoadingPage', require('./components/LoadingPage.vue').default);
Vue.component('LoadingAll', require('./components/LoadingAll.vue').default);
Vue.component('Nav-Menu', require('./components/NavMenu.vue').default);
Vue.component('pagination', require('./components/PaginationComponent.vue').default);


const app = new Vue({
    el: '#app',
    router,
    linkActiveClass: "active",
});
