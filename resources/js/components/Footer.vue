<template>
  <footer class="footer">
    <button v-if="isLogin" class="button button--link" @click="logout">Logout</button>
    <div v-else class="my-navbar__item">
      <RouterLink class="my-navbar-item" to="/login">
        Login
      </RouterLink>
      |
      <RouterLink class="my-navbar-item" to="/register">
        Register
      </RouterLink>
    </div>
  </footer>
</template>

<script>
export default {
  methods: {
    async logout () {
      await this.$store.dispatch('auth/logout')

      this.$router.push('/login')
    }
  },
  computed: {
    isLogin () {
      return this.$store.getters['auth/check']
    }
  },
}
</script>