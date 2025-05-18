<script setup>
import { ref } from "vue";
import draggable from "vuedraggable";

const usergamelist = ref({
  wishlist: [{ rawg_id: 1 }, { rawg_id: 2 }, { rawg_id: 3 }, { rawg_id: 4 }],
  playing: [{ rawg_id: 5 }, { rawg_id: 6 }, { rawg_id: 7 }, { rawg_id: 8 }],
  completed: [
    { rawg_id: 11 },
    { rawg_id: 23 },
    { rawg_id: 21 },
    { rawg_id: 98 },
  ],
});
</script>

<template>
  <section class="container w-100 py-3">
    <div class="row g-3 flex-column flex-md-row">
      <div class="col-12 col-md-4">
        <h1>Wishlist</h1>
        <draggable
          class="list-group"
          :list="usergamelist.wishlist"
          group="usergame"
          item-key="name"
        >
          <template class="list-group-item" #item="{ element }">
            <div class="list-group-item">{{ element.rawg_id }}</div>
          </template>
        </draggable>
      </div>
      <div class="col-12 col-md-4">
        <h1>Playing</h1>
        <draggable
          class="list-group"
          :list="usergamelist.playing"
          group="usergame"
          item-key="name"
        >
          <template #item="{ element }">
            <div class="list-group-item">{{ element.rawg_id }}</div>
          </template>
        </draggable>
      </div>
      <div class="col-12 col-md-4">
        <h1>Completed</h1>
        <!-- Have to be in the same group to be draggable -->
        <draggable
          class="list-group"
          :list="usergamelist.completed"
          group="usergame"
          item-key="name"
        >
          <template class="list-group-item" #item="{ element }">
            <div class="list-group-item">{{ element.rawg_id }}</div>
          </template>
        </draggable>
      </div>
    </div>
  </section>
</template>

<style scoped>
.list-group-item {
  cursor: grab;
  transition: background 0.2s ease;
}
.list-group-item:hover {
  background-color: var(--bs-brown);
  color: var(--bs-light);
}
</style>
