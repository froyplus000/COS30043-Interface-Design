<script setup>
import { ref } from "vue";
const showTerms = ref(false);
const userinput = ref({
  fName: "",
  lName: "",
  dob: "",
  userName: "",
  pw: "",
  cpw: "",
  email: "",
  street: "",
  suburb: "",
  postcode: "",
  phone: "",
  jobCategory: "",
});

const nameRules = [
  (v) => !!v || "Name Required",
  (v) => /^[A-Za-z]+$/.test(v) || "Letter only",
];
const dobRules = [
  (v) => !!v || "Date of Birth is required",
  (v) => {
    if (!v) return true; // don't double validate if empty
    const today = new Date();
    const birthDate = new Date(v);
    const sixteenYearsAgo = new Date(
      today.getFullYear() - 16,
      today.getMonth(),
      today.getDate()
    );
    return (
      birthDate <= sixteenYearsAgo || "Applicant must be at least 16 years old"
    );
  },
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

const streetRules = [(v) => v.length <= 40 || "Maximum 40 characters"];
const suburbRules = [(v) => v.length <= 20 || "Maximum 20 characters"];
const postCodeRules = [
  (v) => !!v || "Postcode is required",
  (v) => /^\d{4}$/.test(v) || "Postcode must be exactly 4 digits",
];
const phoneRules = [
  (v) => !!v || "Mobile number is required",
  (v) =>
    /^04\d{8}$/.test(v) ||
    "Mobile number must start with 04 and must be exactly 10 digits",
];
const categoryRules = [(v) => !!v || "Prefered Job Category is required"];
</script>

<template>
  <section class="container w-75 mb-5">
    <h1 class="my-5 text-center">Job Application Form</h1>
    <section class="border px-5 py-4 rounded-5">
      <v-form
        method="post"
        action="http://mercury.swin.edu.au/it000000/formtest.php"
      >
        <!-- Personal Information -->
        <section id="PersonalInfo">
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
          <div class="row">
            <div class="col">
              <v-date-input
                prepend-icon=""
                name="dob"
                v-model="userinput.dob"
                label="Date of Birth"
                :rules="dobRules"
              ></v-date-input>
            </div>
          </div>
        </section>
        <!-- Account Details -->
        <section id="AccountDetail">
          <h2 class="mb-4">Account Details</h2>
          <div class="row">
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
          <div class="row">
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
        <!-- Address -->
        <section id="Address">
          <h2 class="mb-4">Address</h2>
          <div class="row">
            <div class="col">
              <v-text-field
                name="street"
                label="Street Address (Optional):"
                v-model="userinput.street"
                :rules="streetRules"
              ></v-text-field>
            </div>
            <div class="col">
              <v-text-field
                name="suburb"
                label="Suburb (Optional):"
                v-model="userinput.suburb"
                :rules="suburbRules"
              ></v-text-field>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <v-text-field
                name="postcode"
                label="Postcode:"
                v-model="userinput.postcode"
                :rules="postCodeRules"
              ></v-text-field>
            </div>
            <div class="col">
              <v-text-field
                name="phone"
                label="Mobile Number:"
                v-model="userinput.phone"
                :rules="phoneRules"
              ></v-text-field>
            </div>
          </div>
        </section>
        <v-select
          label="Your Prefered Job Category"
          :items="[
            'AI',
            'Data Science',
            'Software Development',
            'DevOps',
            'Cyber Security',
          ]"
          v-model="userinput.category"
          :rules="categoryRules"
        ></v-select>
        <!-- Buttons -->
        <div class="row">
          <div class="col">
            <!-- Terms and Condition -->
            <v-btn
              @click="showTerms = !showTerms"
              class="btn btn-brown fw-bold"
              block
            >
              {{
                showTerms
                  ? "Hide Terms and Conditions"
                  : "Show Terms and Conditions"
              }}
            </v-btn>
          </div>
          <div class="col">
            <v-btn type="submit" class="btn btn-brown fw-bold" block>
              Submit
            </v-btn>
          </div>
        </div>

        <div
          v-if="showTerms"
          class="border rounded bg-light p-3 pb-0 mt-3 text-center"
        >
          <p class="fs-5">
            By submitting this application, you agree that the information
            provided may be used by Insight Hire and its partners for the
            purpose of evaluating your eligibility for job opportunities. Your
            data will be handled confidentially and will not be shared for
            marketing purposes. Providing false information may result in
            removal from the application process.
          </p>
        </div>
      </v-form>
    </section>
  </section>
</template>

<style scoped>
.btn {
  transition: all 0.3s ease;
  color: var(--bs-light);
}
.btn:hover {
  background-color: var(--bs-light);
  color: var(--bs-dark);
}
</style>
