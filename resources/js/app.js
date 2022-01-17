require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router'
import { routes }  from './routerPage';
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/vi'
import 'element-ui/lib/theme-chalk/index.css';
import InfiniteLoading from 'vue-infinite-loading';
Vue.use(InfiniteLoading)
Vue.use(ElementUI, { locale })
Vue.use(VueRouter)

Vue.mixin({
    methods: {
        formatNumber(number) {
            return Intl.NumberFormat().format(number);
        },
        timeAgo: function(dateString) {
            const date = new Date(dateString);
            const DAY_IN_MS = 86400000; // 24 * 60 * 60 * 1000
            const today = new Date();
            const seconds = Math.round((today - date) / 1000);
            if (seconds < 20) {
                return 'Vừa xong';
            }
            else if (seconds < 60) {
                return '1 phút trước';
            }
            const minutes = Math.round(seconds / 60);
            if (minutes < 60) {
                return `${minutes} phút trước`;
            }
            const isToday = today.toDateString() === date.toDateString();
            if (isToday) {
                return 'Hôm nay'
            }
            const yesterday = new Date(today - DAY_IN_MS);
            const isYesterday = yesterday.toDateString() === date.toDateString();
            if (isYesterday) {
                return 'Hôm qua'
            }
            const daysDiff = Math.round((today - date) / (1000 * 60 * 60 * 24));
            if (daysDiff < 30) {
                return `${daysDiff} ngày trước`;
            }
            const monthsDiff = today.getMonth() - date.getMonth() + (12 * (today.getFullYear() - date.getFullYear()));
            if (monthsDiff < 12) {
                return `${monthsDiff} tháng trước`;
            }
            const yearsDiff = today.getYear() - date.getYear();
            return `${yearsDiff} năm trước`;
        }
    }
});
const router = new VueRouter({
    mode: 'history',
    routes,
})
Vue.component('Modal', require('./components/Modal.vue').default);
Vue.component('LoadingPage', require('./components/LoadingPage.vue').default);
Vue.component('LoadingAll', require('./components/LoadingAll.vue').default);
Vue.component('pagination', require('./components/PaginationComponent.vue').default);

const app = new Vue({
    el: '#app',
    router,
    linkActiveClass: "active",
    fullscreenLoading: true,
});
