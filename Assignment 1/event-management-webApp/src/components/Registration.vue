<script setup>
import eventData from "../assets/events.json";
import { ref, computed } from "vue";

const categories = [...new Set(eventData.map((event) => event.category))];

const userinput = ref({
  username: "",
  password: "",
  confirmPassword: "",
  category: "Business", // default value
  eventName: "",
});
const submitInput = ref({
  username: "",
  category: "",
  eventName: "",
});

const userSubmit = () => {
  submitInput.value.username = userinput.value.username;
  submitInput.value.category = userinput.value.category;
  submitInput.value.eventName = userinput.value.eventName;
};

const filteredEvents = computed(() => {
  return eventData.filter(
    (event) => event.category === userinput.value.category
  );
});

const pwMatched = computed(() => {
  return userinput.value.password === userinput.value.confirmPassword;
});
</script>

<template>
  <section id="register" class="container text-center mt-5">
    <h1 text>Registration Form</h1>
    <!-- FORM -->
    <form
      class="container my-5 p-5 border rounded"
      @submit.prevent="userSubmit"
    >
      <fieldset>
        <!-- Username -->
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input
            type="text"
            class="form-control"
            id="username"
            name="username"
            placeholder="Enter username"
            v-model="userinput.username"
          />
        </div>

        <!-- Password -->
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input
            type="password"
            class="form-control"
            id="password"
            name="password"
            placeholder="Enter password"
            v-model="userinput.password"
            @change="pwMatched"
          />
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
          <label for="confirm-password" class="form-label"
            >Confirm Password</label
          >
          <input
            type="password"
            class="form-control"
            id="confirm-password"
            name="confirm-password"
            placeholder="Re-enter password"
            v-model="userinput.confirmPassword"
          />
          <div class="form-text text-danger" v-if="!pwMatched">
            Passwords do not match.
          </div>
        </div>
      </fieldset>
      <!-- Test INPUT -->
      <!-- <h1>
        TEST INPUT : {{ userinput.username }} {{ userinput.password }}
        {{ userinput.confirmPassword }} {{ userinput.category }}
        {{ userinput.eventName }}
      </h1> -->
      <!-- Category Radio Buttons -->
      <fieldset class="my-4">
        <legend class="form-label">Select Event Category</legend>

        <!-- For -->
        <div class="form-check form-check-inline" v-for="cat in categories">
          <input
            class="form-check-input"
            type="radio"
            :id="cat"
            :name="cat"
            v-model="userinput.category"
            :value="cat"
          />
          <label class="form-check-label" :for="cat">{{ cat }}</label>
        </div>
      </fieldset>

      <!-- Event Dropdown -->
      <div class="mb-3">
        <label for="event-select" class="form-label fs-4">Select Event</label>
        <select
          class="form-select"
          id="event-select"
          v-model="userinput.eventName"
        >
          <option disabled>Choose an event</option>
          <option v-for="event in filteredEvents" :value="event.eventname">
            {{ event.eventname }}
          </option>
        </select>
      </div>

      <button type="submit" class="btn btn-brown text-light mt-3">
        Submit
      </button>
      <!-- Summary -->
      <div class="alert alert-success mt-4" v-if="submitInput.username">
        <strong>Summary:</strong><br />
        Username: {{ submitInput.username }}<br />
        Category: {{ submitInput.category }}<br />
        Event: {{ submitInput.eventName }}
      </div>
    </form>
  </section>
</template>

<style scoped></style>
