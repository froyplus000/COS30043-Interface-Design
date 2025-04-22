<script setup>
import jobs from "../assets/jobs.json";
</script>

<template>
  <section id="joblist" class="list-group w-25">
    <router-link to="/" class="list-group-item">Overview</router-link>
    <router-link
      v-for="job in jobs"
      :key="job.job_id"
      :to="`/${job.job_id}`"
      class="list-group-item"
    >
      {{ job.job_id }}
    </router-link>
  </section>
</template>

<style scoped>
.list-group-item {
  font-size: 1.25rem;
  color: var(--bs-light);
  background-color: var(--bs-brown);
  transition: all 0.3s ease-in;
}
.list-group-item:hover {
  background-color: var(--bs-light);
  color: var(--bs-dark);
  font-weight: bold;
  font-size: 1.3rem;
}
</style>
