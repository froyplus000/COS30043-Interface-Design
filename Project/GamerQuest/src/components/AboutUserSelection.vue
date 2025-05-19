<script setup>
import { ref } from "vue";

const fname = ref("");
const lname = ref("");
const gamerType = ref("");
</script>
<template>
  <h1 class="mb-5">Welcome {{ fname }} {{ lname }}</h1>
  <div class="container form_container w-100 text-center">
    <v-text-field v-model="fname" label="First Name"></v-text-field>
    <v-text-field v-model="lname" label="Last Name"></v-text-field>

    <v-radio-group v-model="gamerType" inline>
      <v-radio label="Casual Gamer" value="casual"></v-radio>
      <v-radio label="Serious Gamer" value="serious"></v-radio>
      <v-radio label="Pro Player" value="pro"></v-radio>
    </v-radio-group>
    <!-- Display image based on selection -->
    <div class="text-center mt-4">
      <img
        v-if="gamerType === 'casual'"
        src="../assets/images/casual.png"
        alt="Portrait image in pixel art style of guy representing a casual gamer."
        class="img-fluid rounded-xl w-75"
      />
      <img
        v-else-if="gamerType === 'serious'"
        src="../assets/images/serious.png"
        alt="Portrait image in pixel art style of guy representing a serious gamer."
        class="img-fluid rounded-xl w-75"
      />
      <img
        v-else-if="gamerType === 'pro'"
        src="../assets/images/pro.png"
        alt="Portrait image in pixel art style of guy representing a pro player/gamer."
        class="img-fluid rounded-xl w-75"
      />
    </div>
  </div>
</template>
