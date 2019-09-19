<template>
  <div v-if="user">
    <nav class="panel panel-default">
      <div class="panel-heading">プロフィール編集</div>
      <div class="panel-body">
        <form class="form" @submit.prevent="update">
          <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="text" class="form-control" id="email" v-model="user.email">
          </div>
          <div class="form-group">
            <label for="username">名前</label>
            <input type="text" class="form-control" id="username" v-model="user.name">
          </div>
          <div class="text-right">
            <button type="submit" class="btn btn-primary">保存</button>
          </div>
        </form>
      </div>
    </nav>
  </div>
</template>

<script>
import { OK } from '../util'

export default {
  props: {
    id: {
      type: String,
      required: true
    },
  },
  data () {
    return {
      user: null,
    }
  },
  methods: {
    async fetchUser () {
      const response = await axios.get(`/api/users/${this.id}/edit`)

      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }

      this.user = response.data
    },
    async update () {
      const response = await axios.post('/api/users/{id}/update',  { email: this.user.email, name: this.user.name })

      this.$router.push(`/users/${response.data.id}`)
    } 
  },
  watch: {
    $route: {
      async handler () {
        await this.fetchUser()
      },
      immediate: true
    }
  }
}
</script>