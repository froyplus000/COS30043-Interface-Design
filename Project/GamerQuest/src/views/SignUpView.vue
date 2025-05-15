<script setup>
import { ref } from "vue";

const message = ref("");
const success = ref(null);

const userinput = ref({
  fName: "",
  lName: "",
  userName: "",
  pw: "",
  cpw: "",
  email: "",
});

async function handleSubmit() {
  // PHP will need to handle data send in FormData.
  const formData = new FormData();
  formData.append("firstname", userinput.value.fName);
  formData.append("lastname", userinput.value.lName);
  formData.append("username", userinput.value.userName);
  formData.append("password", userinput.value.pw);
  formData.append("email", userinput.value.email);

  try {
    const res = await fetch(import.meta.env.VITE_API_URL + "/api/signup.php", {
      method: "POST",
      body: formData,
    });
    const data = await res.json();
    success.value = data.success;
    message.value = data.message;

    if (data.success) {
      userinput.fName = "";
      userinput.lName = "";
      userinput.userName = "";
      userinput.pw = "";
      userinput.cpw = "";
      userinput.email = "";
    }
  } catch (err) {
    success.value = false;
    message.value = err;
  }
}

// Form Validation - Rules
const nameRules = [
  (v) => !!v || "Name Required",
  (v) => /^[A-Za-z]+$/.test(v) || "Letter only",
];
const userNameRules = [
  (v) => !!v || "Username is required",
  (v) => (v && v.length >= 3) || "Username needs minimum 3 characters",
];
const pwRules = [
  (v) => !!v || "Password is required",
  (v) => (v && v.length >= 8) || "Password needs minimum 8 characters",
  (v) =>
    /[$%^&*]/.test(v) ||
    "Password must include at least one special character ($, %, ^, &, *)",
];
const cpwRules = [
  (v) => !!v || "Confirm Password is required",
  (v) => v === userinput.value.pw || "Password not match",
];
const emailRules = [
  (v) => !!v || "Email is required",
  (v) =>
    /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/.test(v) || "Email must be valid",
];
</script>

<template>
  <section
    id="registration-form"
    class="d-flex align-items-center justify-content-center"
  >
    <div class="container w-100 section-responsive">
      <h1 class="text-center mb-5">Create Your Account</h1>

      <v-form>
        <!-- Personal Information -->
        <section>
          <h2 class="mb-4">Personal Information</h2>
          <div class="row">
            <div class="col">
              <v-text-field
                name="fName"
                label="First Name:"
                v-model="userinput.fName"
                :rules="nameRules"
              ></v-text-field>
            </div>
            <div class="col">
              <v-text-field
                name="lName"
                label="Last Name:"
                v-model="userinput.lName"
                :rules="nameRules"
              ></v-text-field>
            </div>
          </div>
        </section>

        <!-- Account Details -->
        <section>
          <h2 class="mb-4">Account Details</h2>
          <div class="row gx-2">
            <div class="col">
              <v-text-field
                name="userName"
                label="Username:"
                v-model="userinput.userName"
                :rules="userNameRules"
              ></v-text-field>
            </div>
            <div class="col">
              <v-text-field
                name="pw"
                label="Password:"
                v-model="userinput.pw"
                :rules="pwRules"
              ></v-text-field>
            </div>
          </div>
          <div class="row gx-2">
            <div class="col">
              <v-text-field
                name="cpw"
                label="Confirm Password:"
                v-model="userinput.cpw"
                :rules="cpwRules"
              ></v-text-field>
            </div>
            <div class="col">
              <v-text-field
                name="email"
                label="Email:"
                v-model="userinput.email"
                :rules="emailRules"
              ></v-text-field>
            </div>
          </div>
        </section>
        <v-btn block class="bg-brown" @click="handleSubmit">Sign Up</v-btn>
      </v-form>

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
#registration-form {
  min-height: 80dvh;
}
@media (min-width: 992px) {
  /* Bootstrap's lg breakpoint */
  .section-responsive {
    width: 70dvw !important;
  }
}
</style>
