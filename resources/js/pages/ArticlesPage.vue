<template>
    <div class="main-container">
        <div class="blog-pages-wrapper section-space--ptb_100 border-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="main-blog-wrap">
                            <Articles :articles="articles" :currentPage="currentPage"
                                      :perPage="perPage" :currentArticleRoute = "currentArticleRoute"/>

                            <div class="overflow-auto">
                                <b-pagination
                                    class="amsda"
                                    limit="5"
                                    v-model="currentPage"
                                    :total-rows="rows"
                                    :per-page="perPage"
                                    align="fill"
                                    style="width: 50%;
                                            margin-left: auto;
                                            margin-right: auto;"
                                ></b-pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Articles from '../components/sections/Articles'

export default {
    name: "ArticlesPage",
    props: {
        'articles': {
            type: Array,
            default: () => []
        },
        'currentArticleRoute': {
            type: String,
        }
    },
    components: {
        Articles,
    },
    data() {
        return {
            perPage: 4,
            currentPage: 1,
            items: this.articles,
        }
    }, computed: {
        rows() {
            return this.items.length
        }
    }

}
</script>

<style scoped>

.overflow-auto {
    margin-top: 10%;
}

.page-link {
    color: #5E61E7;
}

.page-item .page-link {
    background-image: linear-gradient(
        218deg, #5E61E7 0, #9C7AF2 50%, #5E61E7 100%);
}

</style>
