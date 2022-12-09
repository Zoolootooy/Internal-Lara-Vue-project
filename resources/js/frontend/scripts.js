import Forms from '../core/Forms';

// new Vue({
//     el: '#app',
//
//     data: {
//         forms: new Forms('sp-form'),
//
//         showModal: false
//     }
// });

import Vue from 'vue'
import VueAwesomeSwiper from 'vue-awesome-swiper'
import BootstrapVue from 'bootstrap-vue'
import VueSilentbox from 'vue-silentbox'
import Navbar from '../components/Navbar'
import Footer from '../components/Footer'
import {VueMasonryPlugin} from 'vue-masonry'
import WOW from 'wow.js/dist/wow.js'
import VueMeta from 'vue-meta'

Vue.use(VueMasonryPlugin)
Vue.use(VueSilentbox)
Vue.use(BootstrapVue)
Vue.use(VueAwesomeSwiper)
Vue.use(VueMeta, {
    refreshOnceOnNavigation: true
})

import 'bootstrap/dist/css/bootstrap.css'
import '../../scss/aeroland/css/fontawesome-all.min.css'
import 'swiper/dist/css/swiper.css'
import 'animate.css/animate.min.css'
// import '../../scss/aeroland/style.scss'
// import '../../scss/aeroland/style.scss'
import 'slick-carousel/slick/slick.css'

// new Vue ({
//     el: '#navbar',
//     components: {
//         Navbar
//     },
//     render: h => h (Navbar)
// });
// new Vue ({
//     el: '#footer',
//     components: {
//         Footer
//     },
//     render: h => h (Footer)
// });
