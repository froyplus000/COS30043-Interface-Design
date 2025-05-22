<script setup>
import { ref, onMounted } from "vue";
import draggableComponent from "vuedraggable";
import axios from "axios";

// Mock data
const usergamelist = ref({
  wishlist: [],
  playing: [],
  completed: [],
});

// 2. Fetch user's game list
async function fetchUserGameList() {
  try {
    const response = await axios.get(
      import.meta.env.VITE_API_URL + "/api/get_user_games.php",
      {
        withCredentials: true,
      }
    );

    if (response.data.success) {
      usergamelist.value = response.data.usergamelist;
    } else {
      console.error("Failed to load game list:", response.data.message);
    }
  } catch (err) {
    console.error("Error fetching user game list:", err);
  }
}
// 3. Change status based on interaction
async function handleChangeStatus(newStatus, event) {
  const movedGame = event.added?.element;
  if (!movedGame) return;

  try {
    const response = await axios.post(
      import.meta.env.VITE_API_URL + "/api/update_game_status.php",
      {
        rawg_id: movedGame.rawg_id,
        status: newStatus,
      },
      {
        withCredentials: true,
      }
    );

    if (!response.data.success) {
      console.error("Failed to update status:", response.data.message);
    }
  } catch (error) {
    console.error("Error updating game status:", error);
  }
}

onMounted(() => {
  fetchUserGameList();
});
</script>

<template>
  <section class="container w-100 py-3">
    <div class="row flex-column flex-md-row">
      <div class="col-12 col-md-4">
        <h2>Wishlist</h2>
        <draggableComponent
          class="list-group"
          :list="usergamelist.wishlist"
          item-key="game"
          group="usergame"
          @change="(e) => handleChangeStatus('wishlist', e)"
        >
          <template #item="{ element }">
            <div class="list-group-item">{{ element.gamename }}</div>
          </template>
        </draggableComponent>
      </div>
      <div class="col-12 col-md-4">
        <h2>Playing</h2>
        <draggableComponent
          class="list-group"
          :list="usergamelist.playing"
          item-key="game"
          group="usergame"
          @change="(e) => handleChangeStatus('playing', e)"
        >
          <template #item="{ element }">
            <div class="list-group-item">{{ element.gamename }}</div>
          </template>
        </draggableComponent>
      </div>
      <div class="col-12 col-md-4">
        <h2>Completed</h2>
        <draggableComponent
          class="list-group"
          :list="usergamelist.completed"
          item-key="game"
          group="usergame"
          @change="(e) => handleChangeStatus('completed', e)"
        >
          <template #item="{ element }">
            <div class="list-group-item">{{ element.gamename }}</div>
          </template>
        </draggableComponent>
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
