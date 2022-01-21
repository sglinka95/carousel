<template>
    <div class="carousel-container">
      <div class="inner">
        <carousel-item 
            v-for="(slide, index) in slides" 
            :key="slide.id"
            :slide="slide"
            :current-slide="currentSlide"
            :index="index"
            :back="back"
            @mouseenter="stopSlide"
            @mouseout="startSlide"
            />
        <carousel-controls
            v-if="controls"
            @prev="prev"
            @next="next"
          />  
      </div>
    </div>
</template>

<script>
import CarouselItem from "./CarouselItem.vue";
import CarouselControls from "./CarouselControls.vue";

export default {
  components: { CarouselItem, CarouselControls },
  props: {
    slides: {
      type: Array,
      required: true,
    },
    controls: {
      type: Boolean,
      default: false,
    },
    interval: {
      type: Number,
      default: 5000,
    },
  },
  data() {
      return {
          currentSlide: 0,
          slideInterval: null,
          back: false,
      }
  },
  methods: {
    setCurrentSlide(index) {
      this.currentSlide = index;
    },
    prev(step = -1) {
      const index =
        this.currentSlide > 0
          ? this.currentSlide + step
          : this.slides.length - 1;
      this.setCurrentSlide(index);
      this.back = true;
      this.startSlide();
    },
    _next(step = 1) {
      const index =
        this.currentSlide < this.slides.length - 1
          ? this.currentSlide + step
          : 0;
      this.setCurrentSlide(index);
      this.back = false;
    },
    next(step = 1) {
      this._next(step);
      this.startSlide();
    },
    startSlide() {
      this.stopSlide();
      this.slideInterval = setInterval(() => {
        this._next();
      }, this.interval);
    },
    stopSlide() {
      clearInterval(this.slideInterval);
    },
  },
  mounted() {
    this.startSlide();
  },
  beforeUnmount() {
    this.stopSlide();
  },
};
</script>
<style scoped>
.carousel-container {
  display: flex;
  justify-content: center;
}

.inner {
  position: relative;
  width: 900px;
  height: 400px;
  overflow: hidden;
}
</style>