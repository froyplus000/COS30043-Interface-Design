<template>
  <section id="homeCarousel" class="carousel slide">
    <div class="carousel-inner">
      <!-- First Carousel -->
      <div class="carousel-item active">
        <img
          src="../assets/images/console.png"
          class="d-block w-100"
          alt="Image of a person holding playstation 4 controller."
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
          src="../assets/images/pc.png"
          class="d-block w-100"
          alt="Image of a male, siiting in his gaming pc set up."
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
          src="../assets/images/handheld.png"
          class="d-block w-100"
          alt="Image of a person playing game on a white nintendo switch."
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
  background-color: rgba(0, 0, 0, 0.65); /* brown with 60% opacity */
}
</style>
