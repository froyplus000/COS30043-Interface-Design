<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import axios from "axios";

const route = useRoute();
const gameId = route.params.gameId;

const API_KEY = "057d92d1a37442dabc4f22ad6175149a";
const game = ref(null);
const error = ref(null);

const fetchGameDetail = async () => {
  try {
    const response = await axios.get(
      `https://api.rawg.io/api/games/${gameId}`,
      {
        params: {
          key: API_KEY,
        },
      }
    );
    game.value = response.data;
  } catch (err) {
    error.value = "Failed to fetch game detail.";
    console.error(err);
  }
};

onMounted(() => {
  fetchGameDetail();
});
</script>

<template>
  <section v-if="game" class="container section-responsive w-100 my-5">
    <h2 class="mb-3">{{ game.name }}</h2>

    <!-- Image -->
    <img
      :src="game.background_image"
      :alt="game.name"
      class="img-fluid mb-4 rounded shadow"
    />

    <!-- Info Grid -->
    <div class="row mb-4">
      <!-- Left Column -->
      <div class="col-md-6">
        <p><strong>Released: </strong> {{ game.released }}</p>
        <p><strong>Rating: </strong> {{ game.rating }} / 5</p>
        <p>
          <strong>Genres: </strong>
          <span
            class="badge bg-secondary"
            v-for="genre in game.genres"
            :key="genre.id"
          >
            {{ genre.name }}
          </span>
        </p>
        <p>
          <strong>Platforms: <br /></strong>
          <span
            class="badge bg-info mr-1"
            v-for="platform in game.platforms"
            :key="platform.platform.id"
          >
            {{ platform.platform.name }}
          </span>
        </p>
        <p>
          <strong>Tags: <br /></strong>
          <span
            class="badge bg-warning text-dark me-1"
            v-for="tag in game.tags.slice(0, 5)"
            :key="tag.id"
          >
            {{ tag.name }}
          </span>
        </p>
      </div>
      <!-- Right Column -->
      <div class="col-md-6">
        <p><strong>Available on Stores: </strong></p>
        <ul>
          <li v-for="store in game.stores" :key="store.id">
            <a
              class="text-decoration-none text-dark"
              :href="'https://' + store.store.domain"
              target="_blank"
              rel="noopener"
            >
              {{ store.store.name }}
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="row mb-4">
      <div class="col-md-6">
        <!-- Reddit Button -->
        <v-btn
          :href="game.reddit_url"
          class="btn bg-brown mb-4"
          target="_blank"
          rel="noopener"
          v-if="game.reddit_url"
          block
        >
          Visit Reddit Page
        </v-btn>
      </div>
      <div class="col-md-6">
        <v-btn class="btn bg-brown" block>Add to Your Game</v-btn>
      </div>
    </div>

    <!-- Description -->
    <div>
      <h4>Description</h4>
      <div v-html="game.description"></div>
    </div>
  </section>
</template>

<style scoped>
@media (min-width: 992px) {
  /* Bootstrap's lg breakpoint */
  .section-responsive {
    width: 75% !important;
  }
}
</style>
