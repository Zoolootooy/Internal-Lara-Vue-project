<template>
    <div class="feature-icon-list">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-wrapper text-center section-space--pb_20 section-space--pt_40">
                    <h2 class="section-title font-weight--blod wow move-up">Преимущества</h2>
                </div>
            </div>
            <div class="col-lg-8 offset-lg-2">
                <div class="section-title-wrapper text-center section-space--pb_40">
                    <h5 class="section-title font-weight--blod wow move-up">Вот основной список причин почему вам стоит выбрать этот товар.</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4" v-for="part in 2" :key="part" v-bind:class="{'offset-lg-2': (part <= 1)}">
                <div class="feature-icon-list__content">
                    <div class="feature-icon-list-wrapper">
                        <div v-if="part == 1"
                             v-for="(benefit, index) in benefits.slice(0, Math.ceil(benefits.length / 2))"
                             :key="benefit.id" class="single-feature-icon wow move-up">
                            <div class="single-feature-icon__media">
                                <img :src="'storage/files/benefit/' + benefit.id + '/' + benefit.image" class="img-fluid" alt="">
                            </div>
                            <div class="single-feature-icon__content">
                                <h6 class="title">{{ benefit.title }}</h6>
                                <div class="text">{{ benefit.description }}</div>
                            </div>
                        </div>

                        <div v-if="part == 2" v-for="(benefit, index) in benefits.slice(Math.ceil(benefits.length / 2))"
                             :key="benefit.id" class="single-feature-icon wow move-up">
                            <div class="single-feature-icon__media">
                                <img :src="'storage/files/benefit/' + benefit.id + '/' + benefit.image" class="img-fluid" alt="">
                            </div>
                            <div class="single-feature-icon__content">
                                <h6 class="title">{{ benefit.title }}</h6>
                                <div class="text">{{ benefit.description }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'featureList',
    props: ['benefits'],
}
</script>
