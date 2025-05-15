<script setup>
import { ref, computed } from "vue";
import newsData from "../assets/news.json";

const news = ref(newsData);
const userinput = ref({ date: "", title: "", content: "", category: "" });

const filterNews = computed(() => {
  const selectedDate = userinput.value.date
    ? new Date(userinput.value.date).toISOString().slice(0, 10)
    : "";
  return news.value.filter((n) => {
    return (
      n.title
        .toLowerCase()
        .includes(userinput.value.title?.toLowerCase() || "") &&
      n.content
        .toLowerCase()
        .includes(userinput.value.content?.toLowerCase() || "") &&
      n.date.includes(selectedDate) &&
      n.category
        .toLowerCase()
        .includes(userinput.value.category?.toLowerCase() || "")
    );
  });
});
</script>

<template>
  <header class="container header-responsive w-100 text-center py-5">
    <h1 class="mb-5">Gamer News</h1>
    <!-- Search Inputs -->
    <div class="container">
      <div class="row gx-2">
        <div class="col">
          <v-date-input
            v-model="userinput.date"
            :display-value="
              userinput.date
                ? new Date(userinput.date).toISOString().slice(0, 10)
                : ''
            "
            label="Search by Date"
            prepend-icon=""
            variant="underlined"
          ></v-date-input>
        </div>
        <div class="col">
          <v-text-field
            v-model="userinput.title"
            placeholder="New RPG Game Announced"
            variant="underlined"
            label="Search by Title"
          ></v-text-field>
        </div>
      </div>
      <div class="row gx-2">
        <div class="col">
          <v-text-field
            v-model="userinput.content"
            placeholder="Kaze defeated last year's champion in a thrilling final match."
            variant="underlined"
            label="Search by Content"
          ></v-text-field>
        </div>
        <div class="col">
          <v-text-field
            v-model="userinput.category"
            placeholder="Esports"
            variant="underlined"
            label="Search by Category"
          ></v-text-field>
        </div>
      </div>
    </div>
  </header>

  <!-- Display all News -->
  <section class="container w-100 mb-3">
    <div class="row">
      <div
        v-for="n in filterNews"
        :key="n.id"
        class="col-12 col-md-6 col-lg-4 mb-4 d-flex align-items-stretch cursor-default"
      >
        <div class="card w-100">
          <div class="card-body">
            <h3 class="card-title font-primary mb-3">{{ n.title }}</h3>
            <p class="card-text">{{ n.content }}</p>
            <p class="card-text text-muted">Published on: {{ n.date }}</p>
            <p class="bg-brown d-inline px-2 py-1 rounded">{{ n.category }}</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
@media (min-width: 992px) {
  /* Bootstrap's lg breakpoint */
  .header-responsive {
    width: 75% !important;
  }
}
</style>
