<template>
  <section id="homeCarousel" class="carousel slide">
    <div class="carousel-inner">
      <!-- First Carousel -->
      <div class="carousel-item active">
        <img
          src="https://images.unsplash.com/photo-1612725009553-90115a117ceb?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
          class="d-block w-100"
          alt="..."
        />

        <div class="carousel-caption d-block rounded-lg">
          <h5>Console Gamer</h5>
          <p>
            Dive into immersive worlds with a controller in hand. Console gaming
            offers a smooth, plug-and-play experience right from your living
            room.
          </p>
        </div>
      </div>

      <div class="carousel-item">
        <img
          src="https://plus.unsplash.com/premium_photo-1678112180480-a4169c601fa1?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
          class="d-block w-100"
          alt="..."
        />
        <div class="carousel-caption d-block rounded-lg">
          <h5>PC Gamer</h5>
          <p>
            Experience high-performance gameplay and full control. PC gaming
            lets you customize, mod, and push graphics to the next level.
          </p>
        </div>
      </div>
      <div class="carousel-item">
        <img
          src="https://images.unsplash.com/photo-1685567638296-bd4c0ba841a1?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
          class="d-block w-100"
          alt="..."
        />
        <div class="carousel-caption d-block rounded-lg">
          <h5>On the GO Gamer</h5>
          <p>
            Play anytime, anywhere. Whether it's on mobile or handheld consoles,
            portable gaming keeps the fun going wherever life takes you.
          </p>
        </div>
      </div>
    </div>
    <button
      class="carousel-control-prev"
      type="button"
      data-bs-target="#homeCarousel"
      data-bs-slide="prev"
    >
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button
      class="carousel-control-next"
      type="button"
      data-bs-target="#homeCarousel"
      data-bs-slide="next"
    >
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </section>
</template>

<style scoped>
.carousel-caption {
  background-color: rgba(0, 0, 0, 0.5); /* brown with 60% opacity */
}
</style>
