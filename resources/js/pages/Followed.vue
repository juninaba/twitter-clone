<template>
  <div class="tweet-list">
      <div class="grid">
        <FollowUser
          class="grid__item"
          v-for="user in users"
          :key="user.id"
          :item="user"
        />
      </div>
    </div>
</template>

<script>
import { OK } from '../util'
import FollowUser from '../components/FollowUser.vue'

export default {
  components: {
    FollowUser,
  },
  props: {
    id: {
      type: String,
      required: true
    },
  },
  data () {
    return {
      users: null,
    }
  },
  methods: {
    async fetchUser () {
      const response = await axios.get(`/api/users/${this.id}/followed`)

      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }

      this.users = response.data
    },
  },
  watch: {
    $route: {
      async handler () {
        await this.fetchUser()
      },
      immediate: true
    }
  },
}
</script>