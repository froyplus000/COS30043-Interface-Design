<script setup>
import { ref } from "vue";
import axios from "axios";
const userinput = ref({ username: "", password: "" });
const logInMessage = ref({ status: "", message: "" });

async function handleLogIn() {
  try {
    const response = await axios.post(
      import.meta.env.VITE_API_URL + "/api/login.php",
      {
        username: userinput.value.username,
        password: userinput.value.password,
      },
      {
        withCredentials: true,
      }
    );

    logInMessage.value.status = response.data.success;
    logInMessage.value.message = response.data.message;
    if (response.data.success) {
      window.location.reload(); // refresh the page after logged in
    }
  } catch (err) {
    logInMessage.value.status = false;
    logInMessage.value.message = "An error occurred while logging in";
    console.error(err);
  }
}
</script>

<template>
  <section class="d-flex align-items-center justify-content-center">
    <div class="container w-50">
      <h1 class="text-center mb-5">Log In</h1>

      <v-text-field
        v-model="userinput.username"
        label="Enter Username"
        class="mb-2"
      ></v-text-field>

      <v-text-field
        v-model="userinput.password"
        label="Enter Password"
        type="password"
        class="mb-4"
        @keyup.enter="handleLogIn"
      ></v-text-field>

      <v-btn block class="bg-brown" @click="handleLogIn">Log In</v-btn>

      <p
        class="text-center mt-3"
        :class="logInMessage.status === true ? 'text-success' : 'text-danger'"
        v-if="logInMessage.message"
      >
        {{ logInMessage.message }}
      </p>
    </div>
  </section>
</template>

<style scoped>
section {
  min-height: 80dvh;
}
</style>
