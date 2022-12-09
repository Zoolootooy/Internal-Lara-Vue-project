<template>
    <div class="main-container">
        <!--Slider-->
        <Slider :sliders="sliders" />

        <!--Benefits-->
        <FeatureList :benefits="benefits" />

        <!--Articles-->
        <Articles :articles="articles"  :currentPage="currentPage" :perPage="perPage" :currentArticleRoute="currentArticleRoute"/>

        <!--Gallery-->
        <Gallery :gallery="gallery" />

        <!--FAQ-->
        <div class="software-accordion-wrapper section-space--pt_120 section-space--pb_60 gray-gradient" id="faq">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title-wrapper text-center section-space--mb_60">
                            <h2 class="section-title font-weight--light mb-10 wow move-up">Часто задаваемые вопросы</h2>
                            <span
                                class="section-text wow move-up">Мы рады ответить на любые ваши вопросы!</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="faq-wrapper">
                            <!-- accordion component -->
                            <Accordion :elements="faqs.slice(0, Math.ceil(faqs.length /2))"/>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="faq-wrapper soft-accordion-two">
                            <!-- accordion component -->
                            <Accordion :elements="faqs.slice(Math.ceil(faqs.length / 2))"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Screenshot from "../components/Screenshot"
import Slider from "../components/Slider"
import FeatureList from "../components/FeatureList"
import Gallery from "../components/sections/Gallery"
import Articles from '../components/sections/Articles'
import Accordion from "../components/Accordion"


export default {
    name: "HomePage",
    props: {
        'sliders': {
            type: Array,
            default: () => []
        },
        'benefits': {
            type: Array,
            default: () => []
        },
        'articles': {
            type: Array,
            default: () => []
        },
        'gallery': {
            type: Array,
            default: () => []
        },
        'faqs': {
            type: Array,
            default: () => []
        },
        'currentArticleRoute' : {
            type: String,
        }
    },
    components: {
        Screenshot,
        Slider,
        FeatureList,
        Gallery,
        Articles,
        Accordion,
    },
    data() {
        return {
            perPage: 2,
            currentPage: 1,
            items: this.articles,
        }
    }
}
</script>

<style scoped>

</style>
