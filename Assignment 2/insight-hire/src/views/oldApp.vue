<script setup>
import { ref, computed } from "vue";
import jobs from "../assets/jobs.json";

const selectedCategory = ref("");
const showTerms = ref(false);

// Optional: password match logic (frontend validation)
const pw = ref("");
const cpw = ref("");
const dob = ref("");
const passwordsDontMatch = computed(
  () => pw.value !== cpw.value && cpw.value !== ""
);

// Extract unique categories from job list
const jobCategories = computed(() => {
  const categories = jobs.map((job) => job.category);
  return [...new Set(categories)].sort();
});

const isOldEnough = computed(() => {
  if (!dob.value) return true;

  const birthDate = new Date(dob.value);
  const today = new Date();

  const sixteenYearsAgo = new Date(
    today.getFullYear() - 16,
    today.getMonth(),
    today.getDate()
  );

  return birthDate <= sixteenYearsAgo;
});

// Prevent submit if passwords don’t match
function handleSubmit(e) {
  if (passwordsDontMatch.value) {
    alert("Passwords do not match.");
    return;
  }
  if (!isOldEnough.value) {
    alert("You must be at least 16 years old.");
    return;
  }
  e.target.submit(); // continue submission
}
</script>

<template>
  <form
    method="post"
    action="http://mercury.swin.edu.au/it000000/formtest.php"
    @submit.prevent="handleSubmit"
  >
    <!-- Personal Information -->
    <fieldset>
      <legend>Personal Information</legend>

      <label for="fName">First Name:</label>
      <input
        type="text"
        name="fName"
        id="fName"
        required
        pattern="^[A-Za-z]+$"
      />

      <label for="lName">Last Name:</label>
      <input
        type="text"
        name="lName"
        id="lName"
        required
        pattern="^[A-Za-z]+$"
      />

      <label for="dob">Date of Birth:</label>
      <input
        type="date"
        name="dob"
        id="dob"
        v-model="dob"
        required
        :class="{ 'is-invalid': !isOldEnough && dob }"
      />
    </fieldset>

    <!-- Account Details -->
    <fieldset>
      <legend>Account Details</legend>

      <label for="uName">Username:</label>
      <input type="text" name="uName" id="uName" required minlength="3" />

      <label for="pw">Password:</label>
      <input
        type="password"
        name="pw"
        id="pw"
        v-model="pw"
        required
        minlength="8"
        pattern="^(?=.*[$%^&*]).{8,}$"
        title="Minimum 8 characters, must include one special character ($, %, ^, &, *)"
      />

      <label for="cpw">Confirm Password:</label>
      <input
        type="password"
        name="cpw"
        id="cpw"
        v-model="cpw"
        required
        :class="{ 'is-invalid': passwordsDontMatch }"
      />
      <p v-if="passwordsDontMatch" class="text-danger">
        Passwords do not match.
      </p>

      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required />
    </fieldset>

    <!-- Address -->
    <fieldset>
      <legend>Address</legend>

      <label for="sAddress">Street Address:</label>
      <input
        type="text"
        name="sAddress"
        id="sAddress"
        maxlength="40"
        placeholder="Optional"
      />

      <label for="suburb">Suburb:</label>
      <input
        type="text"
        name="suburb"
        id="suburb"
        maxlength="20"
        placeholder="Optional"
      />

      <label for="postcode">Postcode:</label>
      <input
        type="text"
        name="postcode"
        id="postcode"
        required
        pattern="^\d{4}$"
        title="Exactly 4 digits"
      />

      <label for="phone">Mobile Number:</label>
      <input
        type="text"
        name="phone"
        id="phone"
        required
        pattern="^04\d{8}$"
        title="Must start with 04 and contain exactly 10 digits"
      />
    </fieldset>

    <!-- Job Category -->
    <fieldset>
      <legend>Preferred Job Category</legend>
      <label for="category">Select a Job Category:</label>
      <select id="category" name="category" v-model="selectedCategory" required>
        <option disabled value="">Please Select Category</option>
        <option
          v-for="category in jobCategories"
          :key="category"
          :value="category"
        >
          {{ category }}
        </option>
      </select>
    </fieldset>

    <!-- Terms & Conditions Toggle -->
    <fieldset>
      <legend>Terms and Conditions</legend>
      <button
        type="button"
        class="btn btn-secondary mb-2"
        @click="showTerms = !showTerms"
      >
        {{ showTerms ? "Hide" : "Show" }} Terms & Conditions
      </button>
      <div v-if="showTerms" class="border p-2 bg-light">
        <p>
          These are placeholder terms. By submitting this application, you agree
          to share your data with Insight Hire and affiliated partners for
          review purposes only.
        </p>
      </div>
    </fieldset>

    <!-- Submit -->
    <button type="submit" class="btn btn-primary mt-3">Submit</button>
  </form>
</template>

<!-- <v-text-field
          name="lName"
          label="Last Name:"
          v-model="userinput.lName"
          :rules="nameRules"
        ></v-text-field> -->
<!-- <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" id="dob" required /> -->

<!-- Account Details - Fields -->
<!-- <fieldset>Account Details</fieldset>
      <label for="uName">Username:</label>
      <input type="text" name="uName" id="uName" required /><br />
      <label for="pw">Password:</label>
      <input type="text" name="pw" id="pw" required /><br />
      <label for="cpw">Confirm Password:</label>
      <input type="text" name="cpw" id="cpw" required /><br />
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required /><br /> -->
<!-- Address - Fields -->
<!-- <fieldset>Address</fieldset>
      <label for="sAddress">Street Address:</label>
      <input type="text" name="sAddress" id="sAddress" required /><br />
      <label for="suburb">Suburb:</label>
      <input type="text" name="suburb" id="suburb" required /><br />
      <label for="postcode">Postcode:</label>
      <input type="text" name="postcode" id="postcode" required /><br />
      <label for="phone">Mobile Number:</label>
      <input type="phone" name="phone" id="phone" required /><br /> -->
<!-- Job Category -->
<!-- <fieldset>Prefered Job Catagory</fieldset>
      <label for="category-select">Job Category</label>
      <select name="category-select" id="category-select" required>
        <option value="">Please Select Category</option>
        <option value="AI">AI</option>
        <option value="Data Science">Data Science</option>
        <option value="Software Development">Software Development</option>
        <option value="DevOps">DevOps</option>
        <option value="Cybersecurity">Cybersecurity</option>
      </select> -->
<!-- Submit Button -->
