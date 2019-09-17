<template>
  <div v-if="tweet" class="tweet-detail">
    <nav class="panel panel-default">
      <div class="list-group">
        <img src="" alt="icon" class="img-circle">
          <div class="list-group-item">
            <span>
              {{ tweet.owner.name }}さん
            </span>
            <span>
              {{ tweet.text }}
            </span>
          </div>
          <div class="tweet__controls">
            <button
              class="tweet__action tweet__action--like"
              title="Like tweet"
            >
              <i class="icon ion-md-heart"></i>12
            </button>
          </div>
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
    }
  },
  data () {
    return {
      tweet: null
    }
  },
  methods: {
    async fetchTweet () {
      const response = await axios.get(`/api/tweets/${this.id}`)

      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }

      this.tweet = response.data
    }
  },
  watch: {
    $route: {
      async handler () {
        await this.fetchTweet()
      },
      immediate: true
    }
  }
}
</script>

<style scoped>
  .tweet__controls {
    text-align: right;
  }
  .tweet__action {
    background: #fff;
    border: 0;
    border-radius: .25rem;
    color: #222;
    cursor: pointer;
    display: inline-block;
    font-size: 1rem;
    line-height: 1;
    margin-left: .25rem;
    opacity: .8;
    outline: none;
    padding: .5em .75em;
  }
  .tweet--like .icon {
    color: #e4406f;
    margin-right: .5em;
  }
</style>