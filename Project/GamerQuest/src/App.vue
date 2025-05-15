<script setup>
import { RouterView } from "vue-router";
import Navbar from "./components/Navbar.vue";
import Footer from "./components/Footer.vue";
</script>

<template>
  <header>
    <Navbar />
  </header>
  <RouterView />
  <Footer></Footer>
</template>

<style scoped></style>
