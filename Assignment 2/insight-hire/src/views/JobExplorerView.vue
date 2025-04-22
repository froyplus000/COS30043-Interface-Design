<script setup>
import JobList from "../components/JobList.vue";
</script>

<template>
  <section id="JobExplorer" class="text-center mb-5">
    <h1 class="my-5">Job Explorer</h1>
    <div class="container d-flex m-auto gap-3">
      <JobList />
      <div class="w-75 border rounded px-5 py-4 text-start">
        <router-view />
      </div>
    </div>
  </section>
</template>

<style scoped></style>
