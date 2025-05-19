<script setup>
import HomeCarousel from "../components/HomeCarousel.vue";
</script>
<template>
  <section class="container header-responsive w-100 py-5">
    <header class="text-center mb-4">
      <h1>Greeting, adventurer</h1>
      <p>
        Welcome to GamerQuest, your personal companion for tracking and
        discovering video games. Whether you're a casual player or a dedicated
        gamer, this platform helps you organize your collection, keep track of
        what you're currently playing, and share your thoughts through reviews.
        Explore new titles, manage your game library, and connect with others
        who share your passion for gaming. GamerQuest is designed to make your
        gaming experience more enjoyable and meaningful.
      </p>
      <!-- Link to Sign up page -->
      <v-btn class="bg-brown">
        <router-link class="text-decoration-none text-light" to="/signup"
          >Join Now</router-link
        >
      </v-btn>
    </header>
    <HomeCarousel />
  </section>
</template>
