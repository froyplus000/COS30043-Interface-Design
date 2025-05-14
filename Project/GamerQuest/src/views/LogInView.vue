<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";

const username = ref("");
const password = ref("");
const message = ref("");
const success = ref(null);

const router = useRouter();

async function handleLogIn() {
  const formData = new FormData();
  formData.append("username", username.value);
  formData.append("password", password.value);

  try {
    const res = await fetch(import.meta.env.VITE_API_URL + "/api/login.php", {
      method: "POST",
      body: formData,
      credentials: "include",
    });

    const data = await res.json();
    success.value = data.success;
    message.value = data.message;

    if (data.success) {
      // Optional: Redirect to home or protected page
      router.push("/");
    }
  } catch (error) {
    success.value = false;
    message.value = "Something went wrong.";
  }
}
</script>

<template>
  <section class="d-flex align-items-center justify-content-center">
    <div class="container w-75">
      <h1 class="text-center mb-5">Log In</h1>

      <v-text-field
        v-model="username"
        label="Enter Username"
        class="mb-2"
      ></v-text-field>

      <v-text-field
        v-model="password"
        label="Enter Password"
        type="password"
        class="mb-4"
      ></v-text-field>

      <v-btn block class="bg-brown" @click="handleLogIn">Log In</v-btn>

      <p
        class="text-center mt-3"
        :class="success ? 'text-success' : 'text-danger'"
        v-if="message"
      >
        {{ message }}
      </p>
    </div>
  </section>
</template>

<style scoped>
section {
  min-height: 80dvh;
}
</style>
