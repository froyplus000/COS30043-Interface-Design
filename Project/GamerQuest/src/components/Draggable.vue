<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import draggable from "vuedraggable";

const usergamelist = ref({
  wishlist: [],
  playing: [],
  completed: [],
});

const fetchUserGameList = async () => {
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
  } catch (error) {
    console.error("Error fetching user game list:", error);
  }
};

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
      <div class="col-12 col-md-4">
        <h2 class="mb-3">Wishlist</h2>
        <draggable
          class="list-group"
          :list="usergamelist.wishlist"
          group="usergame"
          item-key="name"
          @change="(e) => handleChangeStatus('wishlist', e)"
        >
          <template class="list-group-item" #item="{ element }">
            <div class="list-group-item">{{ element.gamename }}</div>
          </template>
        </draggable>
      </div>
      <div class="col-12 col-md-4">
        <h2 class="mb-3">Playing</h2>
        <draggable
          class="list-group"
          :list="usergamelist.playing"
          group="usergame"
          item-key="name"
          @change="(e) => handleChangeStatus('playing', e)"
        >
          <template #item="{ element }">
            <div class="list-group-item">{{ element.gamename }}</div>
          </template>
        </draggable>
      </div>
      <div class="col-12 col-md-4">
        <h2 class="mb-3">Completed</h2>
        <!-- Have to be in the same group to be draggable -->
        <draggable
          class="list-group"
          :list="usergamelist.completed"
          group="usergame"
          item-key="name"
          @change="(e) => handleChangeStatus('completed', e)"
        >
          <template class="list-group-item" #item="{ element }">
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
