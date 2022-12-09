<template>
    <div class="main-container">
        <PurchaseForm :makeDeliveryOrderRoute="makeDeliveryOrderRoute" :makeOrderRoute="makeOrderRoute"
                      :getTagsRoute="getTagsRoute" :product="product" :extraCards="extraCards"
                      :backToSiteRoute="backToSiteRoute"/>
    </div>
</template>

<script>
import PurchaseForm from '../components/PurchaseForm';

export default {
    name: "PurchasePage",
    props: ['makeOrderRoute', 'getTagsRoute', 'product', 'extraCards', 'makeDeliveryOrderRoute', 'backToSiteRoute'],
    components: {
        PurchaseForm,
    },
    mounted: function () {
        console.log(this.getTagsRoute)
    },
}
</script>

<style scoped>

</style>
