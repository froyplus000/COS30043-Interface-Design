<script setup>
import { RouterView } from "vue-router";
import Navbar from "./components/Navbar.vue";
import Banner from "./components/Banner.vue";
</script>

<template>
  <div class="position-relative">
    <!-- Navbar -->
    <Navbar />
    <Banner />
    <!-- Add RouterView for router to display on the screen -->
    <RouterView />
  </div>

  <v-footer
    class="d-flex align-center justify-center ga-2 flex-wrap flex-grow-1 py-3"
  >
    <div class="flex-1-0-100 text-center mt-2">Insight Hire ©2025</div>
  </v-footer>
</template>

<style scoped></style>
