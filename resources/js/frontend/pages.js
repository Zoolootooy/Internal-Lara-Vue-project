import Vue from 'vue';
import HomePage from '../pages/HomePage';
import FeedbackPage from '../pages/FeedbackPage';
import CurrentArticlePage from '../pages/CurrentArticlePage';
import ArticlesPage from '../pages/ArticlesPage';
import PurchasePage from '../pages/PurchasePage';
import Navbar from '../components/Navbar';
import MyFooter from '../components/Footer';

Vue.component('navbar', Navbar)
Vue.component('my-footer', MyFooter)
Vue.component('home-page', HomePage)
Vue.component('feedback-page', FeedbackPage)
Vue.component('current-article-page', CurrentArticlePage)
Vue.component('articles-page', ArticlesPage)
Vue.component('purchase-page', PurchasePage)
new Vue({ el: '#app' })
