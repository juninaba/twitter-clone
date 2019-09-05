<template>
  <nav class="my-navbar">
    <RouterLink class="my-navbar-brand" to="/">
      Twitter-clone
    </RouterLink>
    <div class="my-navbar-control">
      <div v-if="isLogin" class="my-navbar__item">
        <button class="button">
          <i class="icon ion-md-add"></i>
          tweet
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
  </nav>
</template>

<script>
export default {
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