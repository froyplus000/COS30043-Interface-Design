<script setup>
import { ref } from "vue";
import draggable from "vuedraggable";

const usergamelist = ref({
  wishlist: [
    { gameName: "Elden Ring" },
    { gameName: "Dark Soul 3" },
    { gameName: "GTA V" },
    { gameName: "Valorant" },
  ],
  playing: [
    { gameName: "Fire Emblem" },
    { gameName: "Pokemon" },
    { gameName: "The Last of Us" },
    { gameName: "The Legend of Zelda" },
  ],
  completed: [
    { gameName: "Portal 2" },
    { gameName: "Dota 2" },
    { gameName: "Overwatch 2" },
    { gameName: "Fortnite" },
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
            <div class="list-group-item">{{ element.gameName }}</div>
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
            <div class="list-group-item">{{ element.gameName }}</div>
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
            <div class="list-group-item">{{ element.gameName }}</div>
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
  background-color: rgb(248, 248, 248);
}
</style>
