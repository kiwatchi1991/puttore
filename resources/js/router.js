import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import Products from './pages/Products.vue'
import Login from './pages/Login.vue'
import Sample from './pages/sample.vue'

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
  {
    path: '/',
    component: Products
  },
  {
    path: '/login',
    component: Login
    },
    {
    path: '/sample',
    component:Sample
  }
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
  mode: 'history', // ★ 追加
  routes
})

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router