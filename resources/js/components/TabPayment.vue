<template>
    <div class="ht-tab-wrap">
        <b-tabs class="ht-tab-menu wow move-up">
            <b-tab title="Оплата при получении" active>
                <!-- tab content one component -->
                <TabOnlinePaymentContent/>
            </b-tab>
            <b-tab title="Оплатить сейчас">
                <!-- tab content two component -->
                <TabDeliveryPaymentContent :makeDeliveryOrderRoute="makeDeliveryOrderRoute" :currentPrice="currentPrice"
                                           :extra="extra" :selectedTags="selectedTags"
                                           :extraCardsPrice="extraCardsPrice" :backToSiteRoute="backToSiteRoute"
                                           :name="name" :mail="mail" :phone="phone" :address="address"/>
            </b-tab>
        </b-tabs>
    </div>
</template>

<script>
import TabOnlinePaymentContent from './TabOnlinePaymentContent'
import TabDeliveryPaymentContent from './TabDeliveryPaymentContent'

export default {
    name: 'TabOne',
    props: ['currentPrice', 'extra', 'selectedTags', 'extraCardsPrice', 'makeDeliveryOrderRoute', 'backToSiteRoute', 'address', 'phone', 'mail', 'name'],
    components: {
        TabOnlinePaymentContent,
        TabDeliveryPaymentContent,
    }
};
</script>

<style lang="scss">
$borderColor: linear-gradient(
        218deg, #5E61E7 0, #9C7AF2 50%, #5E61E7 100%);

.wow ul {
    //justify-content: space-between !important;
    li {
        &:first-child {
            a {
                border-radius: 12px 0 0 12px !important;
            }
        }

        &:last-child {
            a {
                border-radius: 0 12px 12px 0 !important;
            }
        }

        a[role=tab] {
            //border-radius: 12px 0 0 12px !important;
            //border: 1px solid transparent !important;

            &[aria-selected=true] {
                background: $borderColor !important;
                color: #fff !important;
            }

            &[aria-selected=false] {
                //color: #fff !important;
            }
        }

        margin: 0 !important;
    }
}
</style>
