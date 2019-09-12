<template>
  <div class="col">
    <nav class="panel panel-default">
      <div class="list-group">
        <img src="" alt="icon" class="img-circle">
        <RouterLink
          class="tweet__overlay"
          :to="`/tweets/${item.id}`"
          :title="`View the tweet by ${item.owner.name}`"
        >
          <div class="list-group-item">
            <span>
              {{ item.owner.name }}さん
            </span>
            <span>
              {{ item.text }}
            </span>
          </div>
        </RouterLink>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  props: {
    item: {
      type: Object,
      required: true
    }
  }
}
</script>

<style scoped>
  .rounded-circle {
    display: inline;
  }
  .tweet__overlay {
    display: inline;
  }
</style>