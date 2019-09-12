<template>
  <nav v-show="value" class="panel panel-default tweet-form">
    <div class="panel-body">
      <div v-show="loading" class="panel">
        <Loader>Sending your tweet...</Loader>
      </div>
      <form v-show="! loading" class="form" @submit.prevent="create">
        <div class="errors" v-if="errors">
          <ul v-if="errors.tweet">
            <li v-for="msg in errors.tweet" :key="msg">{{ msg }}</li>
          </ul>
        </div>
        <div class="form-group">
          <textarea class="form__item form-control" rows="5" v-model="text"></textarea>
        </div>
        <p>{{ text }}</p>
        <div class="text-right">
          <button type="submit" class="btn btn-primary">ツイート</button>
        </div>
      </form>
    </div>
  </nav>
</template>

<script>
import { CREATED, UNPROCESSABLE_ENTITY } from '../util'
import Loader from './Loader.vue'

export default {
  components: {
    Loader
  },
  props: {
    value: {
      type: Boolean,
      required: true
    }
  },
  data () {
    return {
      loading: false,
      text: '',
      errors: null
    }
  },
  methods: {
    reset () {
      this.text = ''
      this.$el.querySelector('textarea').value = null
    },
    async create () {
      // ローディング表示
      this.loading = true

      const response = await axios.post('/api/tweets',  { text: this.text })

      // ローディングを非表示
      this.loading = false

      if (response.status === UNPROCESSABLE_ENTITY) {
        this.errors = response.data.errors
        return false
      }

      this.reset()
      this.$emit('input', false)
      
      if (response.status !== CREATED) {
        this.$store.commit('error/setCode', response.status)
        return false
      }

      this.$store.commit('message/setContent', {
        content: 'ツイートが投稿されました！',
        timeout: 6000
      })

      this.$router.push(`/tweets/${response.data.id}`)
    } 
  },
}
</script>

<style scoped>
  .tweet-form {
    border-radius: .25rem;
    box-shadow: 0 6px 12px rgba(0, 0, 0, .3);
    max-height: 75vh;
    max-width: 600px;
    overflow: scroll;
    padding: 1.5rem;
    position: absolute;
    right: 2%;
    top: 3.5rem;
    width: 90%;
    z-index: 1;
  }
</style>