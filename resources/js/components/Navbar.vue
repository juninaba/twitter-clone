<template>
  <nav class="my-navbar">
    <RouterLink class="my-navbar-brand" to="/">
      Twitter-clone
    </RouterLink>
    <div class="my-navbar-control">
      <div v-if="isLogin" class="my-navbar__item">
        <button class="button" @click="showForm = ! showForm">
          <i class="icon ion-md-add"></i>
          ツイート
        </button>
      </div>
      <div v-if="isLogin" class="my-navbar__item">
        <span>
          {{ username }}さん
        </span>
      </div>
      <div v-else class="my-navbar__item">
        <RouterLink class="my-navbar-item" to="/login">
          Login
        </RouterLink>
        |
        <RouterLink class="my-navbar-item" to="/register">
          Register
        </RouterLink>
      </div>
    </div>
    <TweetForm v-model="showForm" />
  </nav>
</template>

<script>
import TweetForm from './TweetForm.vue'

export default {
  components: {
    TweetForm
  },
  data () {
    return {
      showForm: false
    }
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    },
    username () {
      return this.$store.getters['auth/username']
    }
  }
}
</script>