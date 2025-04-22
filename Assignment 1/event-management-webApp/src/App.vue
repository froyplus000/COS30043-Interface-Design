<script setup>
import Navbar from "./components/Navbar.vue";
import Banner from "./components/Banner.vue";
import WhyUs from "./components/WhyUs.vue";
import Event from "./components/Event.vue";
import Registration from "./components/Registration.vue";
</script>

<template>
  <div class="position-relative">
    <!-- Navbar -->
    <Navbar />
    <Banner />
    <main class="container">
      <WhyUs />
      <Event />
      <Registration />
    </main>
  </div>

  <!-- <h1 class="text-primary">Hello world, with Bootstrap</h1> -->
</template>

<style scoped></style>
