/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

const Vue = require('vue');
<<<<<<< Updated upstream
// ルーティングの定義をインポートする
import router from './router'
// ルートコンポーネントをインポートする
import App from './App.vue'
=======
<<<<<<< Updated upstream
=======
// const Sample = require('vue');
// var $ = require('jQuery');
require('./components/hamgurger');
>>>>>>> Stashed changes
>>>>>>> Stashed changes

/**
 * The following block of code may be used to automatically register yourcd
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

<<<<<<< Updated upstream
// Vue.component('example-component', require('./components/UserRegister.vue').default);
// Vue.component('example-component', require('./components/sample.vue').default);
=======
<<<<<<< Updated upstream
Vue.component('example-component', require('./components/UserRegister.vue').default);
=======
// Vue.component('example-component', require('./components/UserRegister.vue').default);
Vue.component('example-component', require('./components/Hamburger.vue').default);
// Sample.component('example-component1', require('./components/Sample.vue').default);
>>>>>>> Stashed changes
>>>>>>> Stashed changes

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

<<<<<<< Updated upstream
new Vue({
    el: '#app',
    router, // ルーティングの定義を読み込む
    components: { App }, // ルートコンポーネントの使用を宣言する
    template: '<App />' // ルートコンポーネントを描画する
});
=======
// n
// new Sample({
//     el: '#sample',
// });

>>>>>>> Stashed changes
