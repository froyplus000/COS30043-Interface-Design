<script setup>
import { ref } from "vue";

const username = ref("");
const password = ref("");
const message = ref("");
const success = ref(null);

async function handleSubmit() {
  // PHP will need to handle data send in FormData.
  const formData = new FormData();
  formData.append("username", username.value);
  formData.append("password", password.value);

  try {
    const res = await fetch(import.meta.env.VITE_API_URL + "/api/signup.php", {
      method: "POST",
      body: formData,
    });
    const data = await res.json();
    message.value = data.message;
    success.value = data.success;

    if (data.success) {
      username.value = "";
      password.value = "";
    }
  } catch (err) {
    success.value = false;
    message.value = err;
  }
}
</script>

<template>
  <section class="d-flex align-items-center justify-content-center">
    <div class="container w-50">
      <h1 class="text-center mb-5">Create Your Account</h1>

      <v-text-field
        v-model="username"
        label="username"
        class="mb-2"
      ></v-text-field>

      <v-text-field
        v-model="password"
        label="password"
        class="mb-4"
      ></v-text-field>

      <v-btn block class="bg-brown" @click="handleSubmit">Sign Up</v-btn>

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
