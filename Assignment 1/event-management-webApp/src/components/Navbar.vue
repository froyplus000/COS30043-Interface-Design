<script setup></script>
<template>
  <nav class="bg-brown text-center position-lg-sticky top-0">
    <div
      class="container py-1 d-flex flex-column flex-lg-row justify-content-between align-items-center"
    >
      <a
        id="logo"
        class="text-decoration-none text-light fs-1 fw-bold"
        href="welcome"
        >Event Managment System</a
      >

      <ul
        id="nav-item"
        class="list-unstyled fs-4 d-flex flex-column flex-lg-row justify-content-between align-items-center mt-3 gap-lg-3"
      >
        <li>
          <a class="navitem" href="#welcome">Home</a>
        </li>
        <li>
          <a class="navitem" href="#event">Event Management</a>
        </li>
        <li>
          <a class="navitem" href="#register">Registration Form</a>
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
