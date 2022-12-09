<template>
    <div class="clinic-work-step-wrap section-space--ptb_80" id="works">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-wrapper text-center section-space--pb_40 section-space--pt_90">
                        <h2 class="section-title font-weight--blod wow move-up">Статьи</h2>
                    </div>
                </div>
            </div>
            <div class="clinic-work-process-step" v-for="(article, index) in articles"
                 v-bind:class="{'section-space--pt_90': (index > 0)}"
                 v-if="index >= (currentPage*perPage-perPage) && index < currentPage*perPage">
                <div class="row" v-if="index % 2 == 0">
                    <div class="col-lg-6 wow move-up">
                        <div class="clinic-work-step__media images-left-ml  text-center">
                            <img :src="'/storage/files/article/' + article.id + '/' + article.image"
                                 class="img-fluid" alt="thumbnail">
                        </div>
                    </div>
                    <div class="col-lg-6 wow move-up">
                        <div class="clinic-work-process-step__content">
                            <div class="app-showcase__inner">
                                <h4 class="font-weight--bold">{{ article.title }}</h4>
                                <div class="sub-text section-space--mb_40">
                                    {{ article.short_description }}
                                </div>
                                <div class="btn-sowcase section-space--mb_40">
                                    <a :href="currentArticleRoute + '/' + article.id"
                                       class="ht-btn ht-btn-md">Подробнее <span class="btn-icon"><i
                                        class="far fa-long-arrow-right"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" v-if="index % 2 == 1">
                    <div class="col-lg-6 order-lg-1 order-2 wow move-up">
                        <div class="clinic-work-process-step__content">
                            <div class="app-showcase__inner">
                                <h4 class="font-weight--bold">{{ article.title }}</h4>
                                <div class="sub-text section-space--mb_40">
                                    {{ article.short_description }}
                                </div>
                                <div class="btn-sowcase section-space--mt_40">
                                    <a :href="currentArticleRoute + '/' + article.id"
                                       class="ht-btn ht-btn-md">Подробнее <span class="btn-icon"><i
                                        class="far fa-long-arrow-right"></i></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-lg-2 order-1 wow move-up">
                        <div class="clinic-work-step__media images-right-mr  text-center">
                            <img :src="'/storage/files/article/' + article.id + '/' + article.image"
                                 class="img-fluid" alt="thumbnail">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
/**
 * Original name = ClinicWorkStep
 */
export default {
    name: 'Article',
    props: ['currentArticleRoute',
        'articles',
        'perPage',
        'currentPage'],
};
</script>

<style>
</style>
