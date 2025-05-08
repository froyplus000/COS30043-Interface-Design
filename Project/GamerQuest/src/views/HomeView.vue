<script setup>
import { ref } from "vue";
import axios from "axios";

const message = ref("");

async function sendMessage() {
  try {
    const response = await axios.post(
      import.meta.env.VITE_API_URL + "/api/login.php",
      {
        message: message.value,
      }
    );

    console.log(response.data);
    message.value = "";
  } catch (error) {
    console.error(error);
  }
}
</script>

<template>
  <div>
    <v-text-field
      name="name"
      label="Enter something bro"
      v-model="message"
      @keyup.enter="sendMessage"
    ></v-text-field>
    <v-btn @click="sendMessage" block>Submit</v-btn>
  </div>
</template>
