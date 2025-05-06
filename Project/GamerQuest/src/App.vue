<script setup>
import { RouterView } from "vue-router";
</script>

<template>
  <div>
    <div>
      <router-link
        id="logo"
        class="text-decoration-none text-light fs-1 fw-bold"
        to="/"
        >Home</router-link
      >
      <router-link class="navitem" to="/about">About</router-link>
    </div>

    <RouterView />
  </div>
</template>

<style scoped></style>
