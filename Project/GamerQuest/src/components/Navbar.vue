<script setup></script>

<template>
  <nav class="bg-brown text-center position-lg-sticky top-0">
    <div
      class="container py-1 d-flex flex-column flex-lg-row justify-content-between align-items-center"
    >
      <router-link
        id="logo"
        class="text-decoration-none text-light fs-1 fw-bold"
        to="/"
        >GamerQuest</router-link
      >
      <ul
        id="nav-item"
        class="list-unstyled fs-4 d-flex flex-column flex-lg-row justify-content-between align-items-center mt-3 gap-lg-3"
      >
        <li>
          <router-link class="navitem" to="/">Home</router-link>
        </li>
        <li>
          <router-link class="navitem" to="/about">About</router-link>
        </li>
        <li>
          <router-link class="navitem" to="/news">News</router-link>
        </li>
      </ul>
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
  text-decoration: underline;
  transition: color 0.3s ease;
}
</style>
