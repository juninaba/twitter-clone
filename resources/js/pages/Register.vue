<template>
  <nav class="panel panel-default">
    <div class="panel-heading">会員登録</div>
    <div class="panel-body">
      <form class="form" @submit.prevent="register">
        <div class="form-group">
          <label for="email">メールアドレス</label>
          <input type="text" class="form-control" id="email" v-model="registerForm.email">
        </div>
        <div class="form-group">
          <label for="username">名前</label>
          <input type="text" class="form-control" id="username" v-model="registerForm.name">
        </div>
        <div class="form-group">
          <label for="password">パスワード</label>
          <input type="password" class="form-control" id="password" v-model="registerForm.password">
        </div>
        <div class="form-group">
          <label for="password_confirmation">パスワード(確認)</label>
          <input type="password" class="form-control" id="password-confirmation" v-model="registerForm.password_confirmation">
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
      registerForm: {
        email: '',
        name: '',
        password: '',
        password_confirmation: ''
      }
    }
  },
  methods: {
    async register () {
      // authストアのresigterアクションを呼び出す
      await this.$store.dispatch('auth/register', this.registerForm)

      // トップページに移動する
      this.$router.push('/')
    }
  }
}
</script>