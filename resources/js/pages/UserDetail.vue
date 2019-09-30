<template>
  <div v-if="user" class="tweet-detail">
    <nav class="panel panel-default">
      <div class="list-group">
        <div class="list-group-item">
          <span>
            {{ user.name }}さん
          </span>
        </div>
        <div v-if="user.id == userid">
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
        <!-- フォロー機能 -->
        <div v-if="userid">
          <div v-if="user.id != userid" class="follow">
            <button v-if="currentFollowing" type="button" class="btn btn-point btn-raised" @click="unfollow">
              <div v-if="sending" class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Sending...</span>
              </div>
              <div v-else>フォロー中</div>
            </button>
            <button v-else type="button" class="btn btn-default btn-raised" @click="follow">
              <div v-if="sending" class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Sending...</span>
              </div>
              <div v-else>
                フォローする
              </div>
            </button>
          </div>
          <div v-else class="count">
            <RouterLink
              :to="`/users/${user.id}/follow`"
            >
              <span>フォロー中 {{ user.followCount }}</span>
            </RouterLink>
            <RouterLink
              :to="`/users/${user.id}/followed`"
            >
              <span>フォロワー {{ user.followedCount }}</span>
            </RouterLink>
          </div>
        </div>
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
    UserTweet,
  },
  props: {
    id: {
      type: String,
      required: true
    },
    following: {
      type: Boolean,
      default: false
    },
  },
  data () {
    return {
      user: null,
      currentFollowing: this.following,
      sending: false
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
      this.user.followCount = response.data.followCount
      this.user.followedCount = response.data.followedCount
    },
    async follow() {
      if (this.sending) {
        return
      }
      this.sending = true
      const data = { id: this.id }
      await axios.post('/api/follow-users', data)
      this.currentFollowing = true
      this.sending = false
    },
    async unfollow() {
      if (this.sending) {
        return
      }
      this.sending = true
      await axios.delete(`/api/follow-users/${this.id}`)
      this.currentFollowing = false
      this.sending = false
    }
  },
  watch: {
    $route: {
      async handler () {
        await this.fetchUser()
      },
      immediate: true
    }
  },
  computed: {
    userid () {
      return this.$store.getters['auth/userid']
    }
  }
}
</script>

<style>
  .follow {
    margin: 5px;
  }
  .count {
    margin: 8px;
  }
</style>