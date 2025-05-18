<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import axios from "axios";

const route = useRoute();
const gameId = route.params.gameId; // Get game id 
const API_KEY = "057d92d1a37442dabc4f22ad6175149a";

const userLoggedIn = ref(false); // Check if user is logged in or not
const edittingReview = ref(false); // For toggle editting state
const username = ref(); // Store a current username of logged in user
const game = ref(null); // Store Information of the game
const reviews = ref([]); // List of all reviews for this game

// Messages
const addGameMessage = ref({ status: "", message: "" });
const addReviewMessage = ref({ status: "", message: "" });
const editReviewMessage = ref({ status: "", message: "" });
const deleteReviewMessage = ref({ status: "", message: "" });

const userinput = ref({ rating: 3.0, comment: "" }); // userinput for reviews
// label for slider rating in the review
const ratingLabels = {
  1: "Bad",
  2: "",
  3: "Average",
  4: "",
  5: "Best",
};

async function fetchGameDetail() {
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
    console.error("Failed to fetch game detail.", err);
  }
}

async function fetchGameReviews() {
  try {
    const response = await axios.post(
      import.meta.env.VITE_API_URL + "/api/get_review.php",
      {
        rawg_id: gameId,
      },
      {
        withCredentials: true,
      }
    );
    // console.log("Full response:", response.data);

    reviews.value = response.data.reviews;
  } catch (err) {
    console.error("Error fetching reviews:", err);
  }
}

async function handleAddGame() {
  addGameMessage.value.status = "";
  addGameMessage.value.message = "";

  try {
    const response = await axios.post(
      import.meta.env.VITE_API_URL + "/api/add_user_game.php",
      {
        rawg_id: gameId,
        gamename: game.value.name, // add game name for draggable
      },
      {
        withCredentials: true,
      }
    );

    if (response.data.success) {
      addGameMessage.value.status = "success";
      addGameMessage.value.message = response.data.message;
    } else {
      addGameMessage.value.status = "fail";
      addGameMessage.value.message = response.data.message;
    }
  } catch (err) {
    addGameMessage.value.status = "fail";
    addGameMessage.value.message = "An error occurred while adding the game.";
    console.error(err);
  }
}
async function handleAddReview() {
  try {
    const response = await axios.post(
      import.meta.env.VITE_API_URL + "/api/add_review.php",
      {
        rawg_id: gameId,
        rating: userinput.value.rating,
        comment: userinput.value.comment,
      },
      {
        withCredentials: true,
      }
    );

    if (response.data.success) {
      addReviewMessage.value.status = "success";
      addReviewMessage.value.message = response.data.message;
      await fetchGameReviews();
    } else {
      addReviewMessage.value.status = "fail";
      addReviewMessage.value.message = response.data.message;
      await fetchGameReviews();

    }
  } catch (err) {
    addReviewMessage.value.status = "fail";
    addReviewMessage.value.message = "An error occurred while adding review.";
    console.error(err);
  }
}
// Edit review for logged in user
async function handleEditReview() {
  try {
    const response = await axios.put(
      import.meta.env.VITE_API_URL + "/api/edit_review.php",
      {
        rawg_id: gameId,
        rating: userinput.value.rating,
        comment: userinput.value.comment,
      },
      {
        withCredentials: true,
      }
    );
    if (response.data.success) {
      editReviewMessage.value.status = "success";
      editReviewMessage.value.message = response.data.message;
      await fetchGameReviews(); // Refresh reviews after edit
      edittingReview.value = false;
    } else {
      editReviewMessage.value.status = "fail";
      editReviewMessage.value.message = response.data.message;
    }
  } catch (err) {
    editReviewMessage.value.status = "fail";
    editReviewMessage.value.message =
      "An error occurred while editing the game.";
    console.error(err);
  }
}

async function handleDeleteReview() {
  try {
    const response = await axios.delete(
      import.meta.env.VITE_API_URL + "/api/delete_review.php",
      {
        data: {
          rawg_id: gameId,
        },
        withCredentials: true,
      }
    );
    if (response.data.success) {
      deleteReviewMessage.value.status = "success";
      deleteReviewMessage.value.message = response.data.message;
      await fetchGameReviews(); // Refresh reviews after delete
    } else {
      deleteReviewMessage.value.status = "fail";
      deleteReviewMessage.value.message = response.data.message;
    }
  } catch (err) {
    deleteReviewMessage.value.status = "fail";
    deleteReviewMessage.value.message = "Failed to delete review.";
    console.error(err);
  }
}

onMounted(async () => {
  try {
    const res = await axios.get(import.meta.env.VITE_API_URL + "/session.php", {
      withCredentials: true,
    });
    userLoggedIn.value = res.data.loggedIn === true;
    username.value = res.data.user;
  } catch (err) {
    console.error("Failed to check session:", err);
    userLoggedIn.value = false;
  }

  await fetchGameDetail();
  await fetchGameReviews();
});
</script>

<template>
  <!-- Game information -->
  <section v-if="game" class="container section-responsive w-100 my-5">
    <h2 class="mb-3">{{ game.name }}</h2>

    <!-- Image -->
    <img
      :src="game.background_image"
      :alt="game.name"
      class="img-fluid mb-4 rounded shadow"
    />

    <!-- Info Grid -->
    <section class="row mb-4">
      <!-- Left Column -->
      <div class="col-md-6">
        <p><strong>Released: </strong> {{ game.released }}</p>
        <p><strong>Rating: </strong> {{ game.rating }} / 5</p>
        <p>
          <strong>Genres: </strong>
          <span
            class="badge bg-secondary mr-1"
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
            class="badge bg-warning text-dark mr-1"
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
    </section>
    <!--  Button section -->
    <section class="row mb-4">
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
        <v-btn
          v-if="userLoggedIn"
          @click="handleAddGame"
          class="btn bg-brown"
          block
          >Add to Your Game</v-btn
        >
        <v-btn v-else class="btn bg-brown" block>
          <router-link to="/login" class="text-decoration-none text-light"
            >Log in to add game</router-link
          >
        </v-btn>
      </div>

      <p
        class="text-center text-success"
        v-if="addGameMessage.status === 'success'"
      >
        {{ addGameMessage.message }}
      </p>

      <p
        class="text-center text-danger"
        v-if="addGameMessage.status === 'fail'"
      >
        {{ addGameMessage.message }}
      </p>
    </section>

    <!-- Description -->
    <div>
      <h4>Description</h4>
      <div v-html="game.description"></div>
    </div>
  </section>

  <!-- Game Review -->
  <section class="container section-responsive w-100 my-5">
    <h1 class="text-center">All Reviews</h1>
    <p v-if="reviews.length === 0" class="mt-4 text-center">
      No Review for this game
      <span class="text-warning">Be the first to review this game</span>
      <hr class="mt-4">
    </p>
    <div v-else>
      <div v-for="(review, index) in reviews" :key="index" class="mb-4">
        <div>
          <h5>Review from : <strong>{{ review.username }}</strong></h5>
          <p>Rated at : {{ review.rating }} out of 5</p>
          <p class="ml-4"><em>{{ review.comment }}</em></p>
        </div>
        <div v-if="review.username == username" class="d-flex gap-3">
          <v-btn
            color="warning"
            density="comfortable"
            @click="
              edittingReview == false
                ? (edittingReview = true)
                : (edittingReview = false)
            "
            >Edit</v-btn
          >
          <v-btn color="danger" density="comfortable" class="text-light" @click="handleDeleteReview"
            >DELETE</v-btn
          >
        </div>
        
        
        <hr />
      </div>
      <v-form v-if="edittingReview == true" class="mt-2">
          <v-slider
            v-model="userinput.rating"
            :max="5"
            :min="1"
            :step="0.1"
            :ticks="ratingLabels"
            tick-size="5"
            show-ticks="always"
            thumb-label
          ></v-slider>
          <v-textarea
            clearable
            label="Comment"
            placeholder="Share your experiences"
            v-model="userinput.comment"
          ></v-textarea>
          <v-btn block class="bg-brown" @click="handleEditReview">Submit</v-btn>
        </v-form>
        <div class="mt-3 text-center">
          <p v-if="(editReviewMessage.success = true)" class="text-success">
            {{ editReviewMessage.message }}
          </p>
          <p v-if="(editReviewMessage.success = false)" class="text-danger">
            {{ editReviewMessage.message }}
          </p>
        </div>
    </div>
  </section>

  <!-- Write Review for Logged in user-->
  <section v-if="userLoggedIn" class="container section-responsive w-100 my-5">
    <div class="text-center">
      <h1 class="mb-4">Write a review for <span class="text-brown">{{ game.name }}</span></h1>
      <!-- Form -->
      <v-form>
        <v-slider
        v-model="userinput.rating"
        :max="5"
        :min="1"
        :step="0.1"
        :ticks="ratingLabels"
        tick-size="5"
        show-ticks="always"
        thumb-label
      ></v-slider>
      <v-textarea
        clearable
        label="Comment"
        placeholder="Share your experiences"
        v-model="userinput.comment"
      ></v-textarea>
      <v-btn block class="bg-brown" @click="handleAddReview">Submit</v-btn>
      </v-form>
      <div class="mt-3">
        <p v-if="(addReviewMessage.success = true)" class="text-success">
          {{ addReviewMessage.message }}
        </p>
        <p v-if="(addReviewMessage.success = false)" class="text-danger">
          {{ addReviewMessage.message }}
        </p>
      </div>
    </div>
  </section>
</template>

<style scoped>
@media (min-width: 992px) {
  /* Bootstrap's lg breakpoint */
  .section-responsive {
    width: 80dvw !important;
  }
}
</style>
