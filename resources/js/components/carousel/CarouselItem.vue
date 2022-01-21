<template>
  <transition :name="transitionEffect">
      <div 
        class="item"
        v-show="currentSlide === index" 
        >
        <div 
          @mouseenter="$emit('mouseenter')"
          @mouseout="$emit('mouseout')"
          class="card inline-block p-2" style="width: 18rem;">
            <img
              @mouseenter="hover = true"
              @mouseout="hover = false"
              class="card-img-top" 
              :src="image" 
              :alt="slide.name">
            <div class="card-body">
              <h5 class="card-title">{{ slide.name }}</h5>
              <p @click="toggleDescription" class="card-text">{{ description }}</p>
            </div>
        </div>
      </div>
  </transition>
</template>

<script>
export default {
    data() {
      return {
        hover: false,
        show: false
      }
    },
    emits: ["mouseenter", "mouseout"],
    props: ["slide", "currentSlide", "index", "back"],
    methods: {
      toggleDescription() {
        this.show = !this.show;
      },
    },
    computed: {
      transitionEffect() {
        return this.back ? "slide-back" : "slide";
      },
      image () {
        if(this.hover == true) {
          return this.slide.images[Math.floor(Math.random() * this.slide.images.length)];
        } else {
          return this.slide.main_image;
        }
      },
      description () {
        if(this.show == true) {
          return this.slide.description;
        } else {
          return this.slide.description.substring(0,29).trim() + "...";
        }
      }
    }
};
</script>
<style scoped>
.card {
  margin: 0 auto;
  cursor: pointer;
}
.card-text:hover {
  font-weight: 600;
}
.item {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: transparent;
}

.slide-leave-active,
.slide-enter-active {
  transition: 1s;
}
.slide-enter {
  transform: translate(100%, 0);
}
.slide-leave-to {
  transform: translate(-100%, 0);
}

.slide-back-leave-active,
.slide-back-enter-active {
  transition: 1s;
}
.slide-back-enter {
  transform: translate(-100%, 0);
}
.slide-back-leave-to {
  transform: translate(100%, 0);
}
</style>