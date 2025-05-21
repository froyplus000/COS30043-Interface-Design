<script setup>
import { ref, onMounted } from "vue";
import draggable from "vuedraggable";
import axios from "axios";
// 1. mock data
// const usergamelist = ref({
//   wishlist: [
//     { gameName: "Elden Ring" },
//     { gameName: "Dark Soul 3" },
//     { gameName: "GTA V" },
//     { gameName: "Valorant" },
//   ],
//   playing: [
//     { gameName: "Fire Emblem" },
//     { gameName: "Pokemon" },
//     { gameName: "The Last of Us" },
//     { gameName: "The Legend of Zelda" },
//   ],
//   completed: [
//     { gameName: "Portal 2" },
//     { gameName: "Dota 2" },
//     { gameName: "Overwatch 2" },
//     { gameName: "Fortnite" },
//   ],
// });
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
    <div class="row g-3 flex-column flex-md-row">
      <!-- Wishlist column -->
      <div class="col-12 col-md-4">
        <h1>Wishlist</h1>
        <draggable
          class="list-group"
          :list="usergamelist.wishlist"
          group="usergame"
          item-key="game"
          @change="(e) => handleChangeStatus('wishlist', e)"
        >
          <template #item="{ element }">
            <div class="list-group-item">{{ element.gamename }}</div>
          </template>
        </draggable>
      </div>
      <!-- Playing column -->
      <div class="col-12 col-md-4">
        <h1>Playing</h1>
        <draggable
          class="list-group"
          :list="usergamelist.playing"
          group="usergame"
          item-key="game"
          @change="(e) => handleChangeStatus('playing', e)"
        >
          <template #item="{ element }">
            <div class="list-group-item">{{ element.gamename }}</div>
          </template>
        </draggable>
      </div>
      <!-- Completed column -->
      <div class="col-12 col-md-4">
        <h1>Completed</h1>
        <draggable
          class="list-group"
          :list="usergamelist.completed"
          group="usergame"
          item-key="game"
          @change="(e) => handleChangeStatus('completed', e)"
        >
          <template #item="{ element }">
            <div class="list-group-item">{{ element.gamename }}</div>
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
