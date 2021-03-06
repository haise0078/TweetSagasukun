/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// 追加
Vue.component('tweet-parent-component', require('./components/TweetParentComponent.vue').default);
Vue.component('tweet-search-component', require('./components/TweetSearchComponent.vue').default);
Vue.component('tweet-show-component', require('./components/TweetShowComponent.vue').default);
Vue.component('favorites-show-component', require('./components/FavoritesShowComponent.vue').default);
Vue.component('favorite-show-component', require('./components/FavoriteShowComponent.vue').default);
Vue.component('select-term-component', require('./components/SelectTermComponent.vue').default);

const tweet_search = new Vue({
    el: '#app',
});