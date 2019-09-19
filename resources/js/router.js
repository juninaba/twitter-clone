import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import TweetList from './pages/TweetList.vue'
import Login from './pages/Login.vue'
import Register from './pages/Register.vue'
import store from './store'
import SystemError from './pages/errors/System.vue'
import TweetDetail from './pages/TweetDetail.vue'
import UserDetail from './pages/UserDetail.vue'
import UserEdit from './pages/UserEdit.vue'

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
  {
    path: '/',
    component: TweetList
  },
  {
    path: '/login',
    component: Login,
    beforeEnter (to, from, next) {
      if (store.getters['auth/check']) {
        next('/')
      } else {
        next()
      }
    }
  },
  {
    path: '/register',
    component: Register
  },
  {
    path: '/tweets/:id',
    component: TweetDetail,
    props: true
  },
  {
    path: '/users/:id',
    component: UserDetail,
    props: true
  },
  {
    path: '/users/:id/edit',
    component: UserEdit,
    props: true
  },
  {
    path: '/500',
    component: SystemError
  }
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
  mode: 'history',
  routes
})

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router