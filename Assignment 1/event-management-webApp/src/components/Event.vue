<script setup>
import eventData from "../assets/events.json";
import { ref, computed } from "vue";
const events = ref(eventData);
const userinput = ref({ id: "", name: "", category: "", duration: "" });

const filterEvents = computed(() => {
  return events.value.filter(
    (event) =>
      event.eventid.toLowerCase().includes(userinput.value.id.toLowerCase()) &&
      event.eventname
        .toLowerCase()
        .includes(userinput.value.name.toLowerCase()) &&
      event.category
        .toLowerCase()
        .includes(userinput.value.category.toLowerCase()) &&
      event.durationhour
        .toString()
        .includes(userinput.value.duration.toLowerCase())
  );
});
</script>

<template>
  <section id="event" class="container text-center">
    <h1>Event Information</h1>
    <form class="container my-5">
      <!-- Text Inputs -->
      <fieldset class="mb-4">
        <legend class="fs-3 mb-3">Search Events</legend>

        <!-- Event ID -->
        <div class="mb-3">
          <label for="id-input" class="form-label fs-5">Event ID</label>
          <input
            type="text"
            id="id-input"
            name="id-input"
            v-model="userinput.id"
            class="form-control"
            placeholder="Enter Event ID"
          />
        </div>

        <!-- Event Name -->
        <div class="mb-3">
          <label for="name-input" class="form-label fs-5">Event Name</label>
          <input
            type="text"
            id="name-input"
            name="name-input"
            v-model="userinput.name"
            class="form-control"
            placeholder="Enter Event Name"
          />
        </div>

        <!-- Duration -->
        <div class="mb-3">
          <label for="duration-input" class="form-label fs-5"
            >Duration (hours)</label
          >
          <input
            type="text"
            id="duration-input"
            name="duration-input"
            v-model="userinput.duration"
            class="form-control"
            placeholder="Enter Duration"
          />
        </div>
      </fieldset>

      <!-- Category Radios -->
      <fieldset class="mb-4">
        <legend class="fs-5 mb-2">Select Category</legend>

        <div class="form-check form-check-inline">
          <input
            class="form-check-input"
            type="radio"
            id="Technology"
            name="category"
            v-model="userinput.category"
            value="Technology"
          />
          <label class="form-check-label" for="Technology">Technology</label>
          <br />
        </div>

        <div class="form-check form-check-inline">
          <input
            class="form-check-input"
            type="radio"
            id="Business"
            name="category"
            v-model="userinput.category"
            value="Business"
          />
          <label class="form-check-label" for="Business">Business</label> <br />
        </div>

        <div class="form-check form-check-inline">
          <input
            class="form-check-input"
            type="radio"
            id="Marketing"
            name="category"
            v-model="userinput.category"
            value="Marketing"
          />
          <label class="form-check-label" for="Marketing">Marketing</label
          ><br />
        </div>

        <div class="form-check form-check-inline">
          <input
            class="form-check-input"
            type="radio"
            id="Finance"
            name="category"
            v-model="userinput.category"
            value="Finance"
          />
          <label class="form-check-label" for="Finance">Finance</label>
        </div>
      </fieldset>
    </form>

    <div class="table-responsive">
      <table
        class="table table-bordered table-hover align-middle text-center text-dark md-shadow"
      >
        <thead class="fs-5">
          <tr>
            <th scope="col" id="EventID">Event ID</th>
            <th scope="col" id="EventName">Event Name</th>
            <th scope="col" id="EventCategory">Event Category</th>
            <th scope="col" id="EventDuration">Duration Hour</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="e in filterEvents" :key="e.eventid">
            <th scope="row" :id="e.eventid">{{ e.eventid }}</th>
            <td :headers="`${e.eventid} EventName`">{{ e.eventname }}</td>
            <td :headers="`${e.eventid} EventCategory`">{{ e.category }}</td>
            <td :headers="`${e.eventid} EventDuration`">
              {{ e.durationhour }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</template>
<style scoped>
thead th {
  background-color: var(--bs-brown);
  color: var(--bs-light);
}
</style>
