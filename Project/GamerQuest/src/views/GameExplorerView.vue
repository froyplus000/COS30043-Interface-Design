<script setup>
import { ref, onMounted, computed } from "vue";
import axios from "axios";

const userinput = ref({ title: "", category: "" }); // User input for search and filter
const games = ref([]); // List of game fetched from the RAWG API
const loading = ref(true); // Loading state
const error = ref(null);
const API_KEY = "057d92d1a37442dabc4f22ad6175149a";

// Pagination
const currentPage = ref(1); // Current page, start at the first page
const gamesPerPage = 6; // Amount of games will display per page

const fetchGames = async () => {
  loading.value = true;
  try {
    const response = await axios.get("https://api.rawg.io/api/games", {
      params: {
        key: API_KEY,
        page_size: 20, // Amount of games to fetch
      },
    });
    games.value = response.data.results;
  } catch (err) {
    error.value = "Failed to load games";
    console.error(err);
  } finally {
    loading.value = false;
  }
};
// Pagination
const paginatedGames = computed(() => {
  const start = (currentPage.value - 1) * gamesPerPage;
  return filterGames.value.slice(start, start + gamesPerPage);
});
const totalPages = computed(() => {
  return Math.ceil(filterGames.value.length / gamesPerPage);
});

const filterGames = computed(() => {
  const title = userinput.value.title.trim().toLowerCase();
  const category = userinput.value.category.trim().toLowerCase();

  return games.value.filter((g) => {
    const matchTitle = g.name.toLowerCase().includes(title);
    const matchCategory =
      !category ||
      g.genres?.some((genre) => genre.name.toLowerCase().includes(category));

    return matchTitle && matchCategory;
  });
});

onMounted(() => {
  fetchGames();
});
</script>

<template>
  <header class="container w-100 header-responsive text-center mt-5">
    <h1 class="mb-4">Explore Game</h1>
    <div class="container w-75">
      <div class="row gx-2">
        <div class="col">
          <v-text-field
            v-model="userinput.title"
            placeholder="New RPG Game Announced"
            variant="underlined"
            label="Search by Title"
          ></v-text-field>
        </div>
        <div class="col">
          <v-select
            v-model="userinput.category"
            placeholder="Choose genre"
            label="Select Category"
            :items="['', 'Shooter', 'RPG', 'Action']"
            variant="underlined"
          ></v-select>
        </div>
      </div>
    </div>
  </header>
  <!-- Display all game -->
  <section class="container w-100 mb-3">
    <v-pagination
      v-model="currentPage"
      :length="totalPages"
      rounded
      class="mb-2"
    ></v-pagination>
    <div v-if="loading">Loading games...</div>
    <div v-if="paginatedGames.length === 0" class="text-center text-muted">
      No games found.
    </div>
    <div v-if="error">{{ error }}</div>
    <div class="row">
      <div
        class="col-12 col-md-6 col-lg-4 mb-3"
        v-for="game in paginatedGames"
        :key="game.id"
      >
        <div class="card h-100 d-flex flex-column">
          <img
            :src="game.background_image"
            class="card-img-top game-image"
            :alt="game.name"
          />
          <div class="card-body p-4 pb-3">
            <h5 class="card-title">{{ game.name }}</h5>
            <p>ID: {{ game.id }}</p>
            <p class="card-text">Rating: {{ game.rating }}</p>
            <p class="card-text">Released: {{ game.released }}</p>
            <!-- Get only first 3 tags -->
            <p>Tags:</p>
            <div
              class="d-inline"
              v-for="tag in game.tags.slice(0, 3)"
              :key="tag.id"
            >
              <span class="badge bg-warning text-light mr-1 px-3">
                {{ tag.name }}
              </span>
            </div>
            <router-link
              :to="`/explorer/${game.id}`"
              class="d-block text-decoration-none"
            >
              <v-btn class="bg-brown mt-3" block>Learn More</v-btn>
            </router-link>
          </div>
        </div>
      </div>
    </div>
    <v-pagination
      v-model="currentPage"
      :length="totalPages"
      rounded
      class="mb-2"
    ></v-pagination>
  </section>
</template>

<style scoped>
.game-image {
  height: 200px; /* adjust to your preferred height */
  object-fit: cover;
}
.card-body p {
  margin-bottom: 0.2rem;
}
</style>
