<script setup>
import { ref, onMounted } from "vue";
import draggable from "vuedraggable";
import axios from "axios";

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
  <section>
    <h1>Hello from Draggable</h1>
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
