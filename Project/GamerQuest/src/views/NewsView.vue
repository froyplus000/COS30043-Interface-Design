<script setup>
import { ref, computed } from "vue";
import newsData from "../assets/news.json";

const news = ref(newsData);
const userinput = ref({ date: "", title: "", content: "", category: "" });
// Pagination
const currentPage = ref(1);
const newsPerPage = 6;

// Calculate the total page for dynamic pagination based on filtered news
const totalPages = computed(() =>
  Math.ceil(filterNews.value.length / newsPerPage)
);

const filterNews = computed(() => {
  /*
      Vuetify Output : Fri May 02 2025 00:00:00 GMT+1000 (Australian Eastern Standard Time)
      Therefore, need to convert to ISO format to be able to fillter news 
  */
  const selectedDate = userinput.value.date
    ? (() => {
        const d = new Date(userinput.value.date);
        d.setDate(d.getDate() + 1); // Have to add one day to match userinput and filtered news, No Idea why this happening
        return d.toISOString().slice(0, 10);
      })()
    : "";

  // Filter and return filtered news to display on the page
  return news.value.filter((n) => {
    return (
      // Select only news that match userinput and return it.
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

// Selects news to show in the current page.
const paginatedNews = computed(() => {
  const start = (currentPage.value - 1) * newsPerPage; // First news to display
  return filterNews.value.slice(start, start + newsPerPage); // from the start, select and return news in the amount of newsPerPage
});
</script>

<template>
  <header class="container header-responsive w-100 text-center py-5">
    <h1 class="mb-5">Gamer News</h1>
    <!-- Uncomment to see the Vuetify date Output -->
    <!-- <h1>{{ userinput.date }}</h1> -->
    <!-- Search Inputs -->
    <div class="container">
      <div class="row gx-2">
        <div class="col">
          <v-date-input
            v-model="userinput.date"
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
    <v-pagination
      v-model="currentPage"
      :length="totalPages"
      rounded
      class="mb-2"
    ></v-pagination>
    <div class="row">
      <div
        v-for="n in paginatedNews"
        :key="n.id"
        class="col-12 col-md-6 col-lg-4 mb-4 d-flex align-items-stretch cursor-default"
      >
        <div class="card w-100">
          <div class="card-body">
            <h3 class="card-title font-primary mb-3">{{ n.title }}</h3>
            <p class="card-text">{{ n.content }}</p>
            <p class="card-text text-muted">Published on: {{ n.date }}</p>
            <span class="badge text-bg-brown text-light p-2">
              {{ n.category }}
            </span>
            <!-- <p class="bg-brown d-inline px-2 py-1 rounded">{{ }}</p> -->
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
