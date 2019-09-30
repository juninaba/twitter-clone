<template>
  <div v-if="item" class="col">
    <div v-for="i in item" :key="i.id">
      <nav class="panel panel-default">
        <div class="list-group">
            <div class="list-group-item">
              <RouterLink
                :to="`/users/${i.id}`"
              >
                <span class="text">
                  {{ i.name }}
                </span>
              </RouterLink>
            </div>
        </div>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    item: {
      type: Array,
      required: true
    },
  }
}
</script>