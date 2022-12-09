<template>
    <div class="hero-software hero-swiper-btn" id="home">
        <div class="container_f1">
            <div class="">
                <b-carousel
                    ref="myCarousel"
                    class="swiper-slide" :style="bgImg"
                    id="carousel-1"
                    controls
                    v-model="slide"
                    :interval="1500"
                    @sliding-start="onSlideStart"
                    @sliding-end="onSlideEnd"
                >
                    <b-carousel-slide
                        v-for="(slider, index) in sliders"
                        :key="slider.id">
                        <template #img>
                            <div class="hero-item">
                                <div class="hero-content">
                                    <h2 class="h1 hero-content-title">{{ slider.name }}</h2>
                                    <h6 class="hero-content-subtitle" v-html="slider.description"></h6>
                                </div>
                                <div class="hero-thumb pr-100">
                                    <img v-if="slider.type === 0"
                                         :src="'/storage/files/slider/' + slider.id + '/' + slider.image"
                                         class="img-fluid" alt="hero thumb">
                                    <img v-if="slider.type === 1"
                                         v-on:click="openOverlayProgramaticallyWithoutContext('silentbox'+slider.id)"
                                         :src="'/storage/files/slider/' + slider.id + '/' + slider.image"
                                         class="img-fluid" alt="hero thumb">
                                </div>
                            </div>
                        </template>
                    </b-carousel-slide>
                </b-carousel>
            </div>
        </div>
        <silentbox-single
            v-for="slider in sliders"
            v-if="slider.type === 1"
            :key="'silentbox-' + slider.id"
            :ref="'silentbox' + slider.id"
            src="https://www.youtube.com/watch?v=9No-FiEInLA">
            <div class="video-play">
                <span class="video-text">
                </span>
            </div>
        </silentbox-single>
    </div>
</template>

<script>
/**
 * Original name = HeroSoftware
 */
export default {
    props: ['sliders'],

    methods: {
        openOverlayProgramaticallyWithoutContext(item) {
            this.$refs[item][0].openSilentBoxOverlay()
        },
        prev() {
            this.$refs.myCarousel.prev()
        },
        next() {
            this.$refs.myCarousel.next()
        },
        onSlideStart(slide) {
            this.sliding = true
        },
        onSlideEnd(slide) {
            this.sliding = false
        }
    },
    data() {
        return {
            bgImg: {
                backgroundImage: `url(${require("../../img/hero/hero-software/software-shape.png")})`
            },
            swiperOption: {
                speed: 1500,
                loop: true,
                effect: 'fade',
                autoplay: true,
                spaceBetween: 30,
                navigation: {
                    nextEl: '.swiper-button-prev',
                    prevEl: '.swiper-button-next'
                },
            },
            slide: 0,
            sliding: null
        };
    }
};
</script>

<style lang="scss" scoped>
@import "../../scss/aeroland/variabls";
@import "../../scss/aeroland/elements/hero-software.scss";
</style>
