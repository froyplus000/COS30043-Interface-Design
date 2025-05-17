<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

// Check if user is logged in or not
const userLoggedIn = ref(false);
onMounted(async () => {
  try {
    const res = await axios.get(import.meta.env.VITE_API_URL + "/session.php", {
      withCredentials: true,
    });
    userLoggedIn.value = res.data.loggedIn === true;
  } catch (err) {
    console.error("Failed to check session:", err);
    userLoggedIn.value = false;
  }
});

async function handleLogout() {
  await fetch(import.meta.env.VITE_API_URL + "/api/logout.php", {
    credentials: "include",
  });
  userLoggedIn.value = false;
  window.location.reload(); // refresh the page after logged in
}
</script>

<template>
  <nav class="bg-brown text-center position-lg-sticky top-0">
    <div
      class="container py-1 d-flex flex-column flex-lg-row justify-content-between align-items-center pb-3 pb-lg-0"
    >
      <router-link
        id="logo"
        class="text-decoration-none text-light fs-1 fw-bold"
        to="/"
        >GamerQuest</router-link
      >
      <ul
        id="nav-item"
        class="list-unstyled fs-4 d-flex flex-column flex-md-row justify-content-between align-items-center mt-3 gap-md-3"
      >
        <!-- Dropdown -->
        <li class="nav-item navitem dropdown">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            Overview
          </a>
          <ul class="dropdown-menu">
            <li>
              <router-link class="dropdown-item" to="/">Home</router-link>
            </li>
            <li>
              <router-link class="dropdown-item" to="/about"
                >About Us</router-link
              >
            </li>
            <li>
              <router-link class="dropdown-item" to="/news">News</router-link>
            </li>
          </ul>
        </li>

        <li>
          <router-link class="navitem" to="/explorer">Explorer</router-link>
        </li>
        <li>
          <router-link class="navitem" to="/popular">Trending</router-link>
        </li>
      </ul>
      <!-- User Logged In -->
      <div
        class="d-flex justify-content-center align-items-center gap-3"
        v-if="userLoggedIn"
      >
        <v-btn density="comfortable" class="navbtn" @click="handleLogout"
          >Logout</v-btn
        >
        <v-btn density="comfortable" class="navbtn">
          <router-link class="text-decoration-none text-dark" to="/profile"
            >My Profile</router-link
          >
        </v-btn>
        <!-- <h5 class="text-light mb-0">Welcome</h5> -->
      </div>
      <!-- User not Log In -->
      <div v-else class="d-flex flex-column flex-md-row gap-3">
        <v-btn density="comfortable" class="navbtn">
          <router-link class="text-decoration-none text-dark" to="/signup"
            >Sign Up</router-link
          >
        </v-btn>
        <v-btn density="comfortable" class="navbtn"
          ><router-link class="text-decoration-none text-dark" to="/login"
            >Log In</router-link
          ></v-btn
        >
      </div>
    </div>
  </nav>
</template>

<style scope>
.navitem {
  color: var(--bs-light);
  text-decoration: none;
}
.navitem:hover {
  color: var(--bs-primary);
  transition: color 0.3s ease;
}
.navbtn {
  color: var(--bs-dark);
}
.navbtn:hover {
  background-color: var(--bs-primary);
  transition: color 0.3s ease;
}
</style>
