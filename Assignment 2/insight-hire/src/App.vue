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
</template>

<style scoped></style>
