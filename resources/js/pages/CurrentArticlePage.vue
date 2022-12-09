<template>
    <div class="main-container">
        <div class="blog-pages-wrapper section-space--ptb_100 border-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title-wrapper text-center section-space--pb_40 section-space--pt_90">
                            <h2 class="section-title font-weight--blod wow move-up">
                                {{ article.title }}</h2>
                        </div>
                    </div>
                </div>

                <div class="clinic-work-process-step">
                        <div class="clinic-work-step__media images-ml text-center">
                            <img :src="'/storage/files/article/' + article.id + '/' + article.image"
                                 class="img-fluid" alt="thumbnail">
                        </div>
                </div>
                <div class="description" v-html="article.description">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AllArticlePage",
    props: ['article'],
}
</script>

<style scoped>
.description {
    font-size: 18px;
}

.images-ml {
    margin: auto;
    width: 80%;
}
</style>
