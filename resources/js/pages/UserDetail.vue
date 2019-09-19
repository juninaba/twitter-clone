<template>
  <div v-if="user" class="tweet-detail">
    <nav class="panel panel-default">
      <div class="list-group">
        <img src="" alt="icon" class="img-circle">
        <div class="list-group-item">
          <span>
            {{ user.name }}さん
          </span>
        </div>
        <RouterLink
          class="tweet__overlay"
          :to="`/users/${user.id}/edit`"
        >
          <div class="list-group-item">
            <span>
              編集
            </span>
          </div>
        </RouterLink>
      </div>
    </nav>
    <div class="tweet-list">
      <div class="grid">
        <UserTweet
          class="grid__item"
          v-for="tweet in user.tweets"
          :key="tweet.id"
          :item="tweet"
        />
      </div>
    </div>
  </div>
</template>

<script>
import { OK } from '../util'
import UserTweet from '../components/UserTweet.vue'

export default {
  components: {
    UserTweet
  },
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
      const response = await axios.get(`/api/users/${this.id}`)

      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }

      this.user = response.data
      this.user.tweets = response.data.tweets
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