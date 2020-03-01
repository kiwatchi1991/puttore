/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

const Vue = require('vue');

// const Sample = require('vue');
// var $ = require('jQuery');
require('./components/hamgurger');
require('./components/previewImage');
require('./components/drop-down');
require('./components/add-lesson');
require('./components/markdown');
require('./components/ajaxLike');
require('./components/ajaxFollow');
require('./components/ajaxCart');
require('./components/toggle-lessonTab');
require('./components/date-picker');
require('./components/slick');


// const Sample = require('vue');
// var $ = require('jQuery');

/**
 * The following block of code may be used to automatically register yourcd
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


Vue.component('textarea-livepreview', require('./components/MarkdownPanel.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


// new Vue({
//     el: '#app',
//     template: '<App />' // ルートコンポーネントを描画する
// });

new Vue({
    el: '#app',// index.htmlでid="app"となっている要素（エレメント）を指定
})

