<script setup>
import bannerImage from "../assets/banner.jpg";
</script>

<template>
  <header
    id="banner"
    :style="`background-image: url(${bannerImage})`"
    class="d-none d-lg-block"
  ></header>
</template>

<style scoped>
#banner {
  width: 100%;
  height: 150px;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  opacity: 0.6;
}
</style>
