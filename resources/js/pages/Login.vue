<template>
  <nav class="panel panel-default">
    <div class="panel-heading">ログイン</div>
    <div class="panel-body">
      <form class="form" @submit.prevent="login">
        <div class="form-group">
          <label for="login-email">メールアドレス</label>
          <input type="text" class="form-control" id="login-email" v-model="loginForm.email">
        </div>
        <div class="form-group">
          <label for="login-password">パスワード</label>
          <input type="password" class="form-control" id="login-password" v-model="loginForm.password">
        </div>
        <div class="text-right">
          <button type="submit" class="btn btn-primary">送信</button>
        </div>
      </form>
    </div>
  </nav>
</template>

<script>
export default {
  data () {
    return {
      loginForm: {
        email: '',
        password: ''
      },
    }
  },
  methods: {
    async login () {
      // authストアのloginアクションを呼び出す
      await this.$store.dispatch('auth/login', this.loginForm)

      // トップページに移動する
      this.$router.push('/')
    },
  }
}
</script>