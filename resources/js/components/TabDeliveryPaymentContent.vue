<template>
    <div class="tab-mission-wrap section-space--mt_20">
        <div class="contact-submit-btn text-center">
            <button class="ht-btn ht-btn-md" v-on:click="payment" type="button">Оплатить заказ</button>
        </div>
    </div>
</template>

<script>

import {default as axios} from "axios";

export default {
    name: 'TabDeliveryPaymentContent',
    props: ['currentPrice', 'extra', 'selectedTags', 'extraCardsPrice', 'makeDeliveryOrderRoute', 'backToSiteRoute', 'address', 'name', 'mail', 'phone'],
    components: {}, methods: {
        payment() {
            const axios = require('axios').default;
            axios({
                method: 'post',
                url: this.makeDeliveryOrderRoute,
                data: {
                    price: this.currentPrice,
                    extra_card_price: this.extraCardsPrice,
                    full_name: this.name,
                    email: this.mail,
                    phone: this.phone,
                    address: this.address,
                    extern_cards: this.extra,
                    request_url: this.backToSiteRoute,
                    extern_cards_list: this.selectedTags,
                }
            }).then((response) => (
                document.location = 'https://www.liqpay.ua/api/3/checkout?data=' + response.data['data'] + '&signature=' + response.data["signature"]
            ))
        }
    }
};
</script>



