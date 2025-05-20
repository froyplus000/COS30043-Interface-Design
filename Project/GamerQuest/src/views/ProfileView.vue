<script setup>
import Draggable from "../components/Draggable.vue";
import { ref, onMounted } from "vue";
import axios from "axios";

const userLoggedIn = ref(false); // Check if user is logged in or not
// Store a current username of logged in user
// const user = ref("");
const user = ref({
  firstname: "",
  lastname: "",
  email: "",
});

onMounted(async () => {
  try {
    const response = await axios.get(
      import.meta.env.VITE_API_URL + "/session.php",
      {
        withCredentials: true,
      }
    );
    userLoggedIn.value = response.data.loggedIn === true;
    user.value = response.data.user;
  } catch (err) {
    console.error("Failed to check session:", err);
    userLoggedIn.value = false;
  }
});
</script>

<template>
  <section class="container w-100 my-5">
    <h1 class="text-center mb-5">Welcome, {{ user.username }}</h1>
    <div v-if="user">
      <p>{{ user.firstname }} {{ user.lastname }}</p>
      <p>{{ user.email }}</p>
    </div>

    <Draggable />
  </section>
</template>
