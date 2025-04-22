<script setup>
// Run once -> Setup
import { ref, watchEffect } from "vue";
import { useRoute } from "vue-router";
import jobs from "../assets/jobs.json";

const route = useRoute();
const job = ref(null); // Create a reactive variable with no value yet

/*  
    Every time the user clicks a <router-link>, the jobId in the URL changes.
    watchEffect() tracks that change and updates the UI automatically by changing job.value. 
*/
watchEffect(() => {
  // Watch for changes inside this
  const jobId = route.params.jobId; // Get value of jobId in our Route
  job.value = jobs.find((j) => j.job_id === jobId); // Assign job and its detail to reactive variable "job"
});
</script>

<template>
  <div v-if="job" class="job-detail">
    <h2>{{ job.job_title }} ({{ job.job_id }})</h2>
    <p><strong>Company:</strong> {{ job.company }}</p>
    <p><strong>Location:</strong> {{ job.location }}</p>
    <p><strong>Category:</strong> {{ job.category }}</p>

    <p><strong>Employment Type:</strong> {{ job.employment_type }}</p>
    <p><strong>Salary Range:</strong> {{ job.salary_range }}</p>
    <p><strong>Job Level:</strong> {{ job.job_level }}</p>

    <p>
      <strong>Required Skills:</strong> {{ job.required_skills.join(", ") }}
    </p>
    <p>
      <strong>Preferred Qualifications:</strong>
      {{ job.preferred_qualifications.join(", ") }}
    </p>

    <p><strong>Description:</strong> {{ job.job_description }}</p>

    <p><strong>Application Deadline:</strong> {{ job.application_deadline }}</p>
    <p><strong>Posted Date:</strong> {{ job.posted_date }}</p>
    <p><strong>Supervisor:</strong> {{ job.supervisor }}</p>
    <p><strong>Positions Available:</strong> {{ job.positions_available }}</p>
    <p><strong>Start Date:</strong> {{ job.start_date }}</p>
    <p>
      <strong>Tags:</strong>
      {{ job.tags.join(", ") }}
    </p>
  </div>

  <div v-else>
    <p>Job not found.</p>
  </div>
</template>
