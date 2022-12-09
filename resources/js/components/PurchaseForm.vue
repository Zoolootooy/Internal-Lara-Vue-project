<template>
    <div class="contact-form-section section-space--ptb_120" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 order-2 order-lg-1">
                    <div class="section-title text-left section-space--mb_40">
                        <h2 class="font-weight--bold mb-15 wow move-up">Покупка товара.</h2>
                        <span class="section-text_left wow move-up">Общий текст.</span>
                    </div>
                    <div class="alert alert-danger" role="alert"
                         v-if="errorMessage != ''">
                        {{ errorMessage }}
                    </div>
                    <div class="alert alert-success" role="alert"
                         v-if="message != ''">
                        {{ message }}
                    </div>
                    <div class="contact-from-wrapper wow move-up">
                        <form id="purchaseForm" @submit.prevent="submitForm">
                            <b-form-checkbox
                                id="checkbox-1"
                                name="extern_cards"
                                size="lg"
                                v-model="extra"
                                value="1"
                                unchecked-value="0"
                            >
                                Дополнительный набор карт
                            </b-form-checkbox>
                            <div class="contact-page-form">

                                <div class="contact-inner">
                                    <input v-if="extra != 0" class="tag-search" id="tag-search" list="tags"
                                           placeholder="Поиск тем"
                                           v-on:change="addNewTag">
                                    <input v-else disabled id="tag-search" list="tags"
                                           placeholder="Выберите тему дополнительного набора карт">
                                    <datalist id="tags">
                                        <option v-for="tag in tags">
                                            {{ tag['name'] }}: {{ tag['price'] }}грн
                                        </option>
                                    </datalist>
                                    <div class="tag-list"
                                         v-if="extra != 0">
                                        <span class="tag"
                                              v-for="tag in selectedTags"
                                              style="display: inline-table;">
                                            {{ tag }}
                                            <a v-on:click="removeTag(tag)">X</a>
                                        </span>
                                    </div>
                                </div>

                                <div class="contact-inner">
                                    <input v-model="name" name="full_name" type="text" placeholder="ФИО *" required>
                                </div>
                                <div class="contact-inner">
                                    <input v-model="mail" name="email" type="email" placeholder="Email *" required>
                                </div>

                                <div class="contact-inner">
                                    <input v-model="phone" name="phone" type="tel" v-mask="'+38 (0##) ###-##-##'"
                                           placeholder="Телефон *" required>
                                </div>

                                <div class="contact-inner">
                                    <input v-model="address" name="address" type="text" placeholder="Адрес доставки *"
                                           required>
                                </div>

                                <div class="fun-fact--three section-space--mb_30">
                                    <span class="fun-fact__count"
                                          v-if="extra != 0">
                                        Цена:
                                        <ICountUp :endVal="parseFloat(currentPrice+extraCardsPrice)"
                                                  :decimals="decimal"/> грн
                                    </span>
                                    <span class="fun-fact__count"
                                          v-else>
                                        Цена:
                                        <ICountUp :endVal="parseFloat(currentPrice)"/> грн
                                    </span>
                                    <h6 class="fun-fact__text"></h6>
                                </div>

                                <TabPayment :makeDeliveryOrderRoute="makeDeliveryOrderRoute"
                                            :currentPrice="currentPrice" :extra="extra" :selectedTags="selectedTags"
                                            :extraCardsPrice="extraCardsPrice" :backToSiteRoute="backToSiteRoute"
                                            :name="name" :mail="mail" :phone="phone" :address="address"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Checkbox from "./elements/Checkbox";
import ICountUp from 'vue-countup-v2';
import {TheMask} from 'vue-the-mask';
import TabPayment from './TabPayment';

export default {
    name: 'PurchaseForm',
    props: ['makeOrderRoute', 'getTagsRoute', 'product', 'extraCards', 'makeDeliveryOrderRoute', 'backToSiteRoute'],
    components: {
        Checkbox,
        ICountUp,
        TheMask,
        TabPayment,
    },
    data() {
        return {
            tags: [],
            selectedTags: [],
            message: "",
            errorMessage: "",
            price: 0,
            extraCardsPrice: 0,
            currentPrice: 0,
            extra: 0,
            decimal: 2,
            name: '',
            mail: '',
            phone: '',
            address: '',
        }
    },
    watch: {
        extra: function () {
            this.currentPrice = parseFloat(this.price);
        }
    },
    computed: {
        csrf() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        },
    },
    mounted: function () {
        const axios = require('axios').default;
        axios({
            method: 'get',
            url: this.getTagsRoute
        }).then((response) => (
            this.tags = response.data.sort()
        ))
        this.price = this.product.price;
        this.currentPrice = this.price;
    },
    methods: {
        submitForm() {
            const axios = require('axios').default;
            axios({
                method: 'post',
                url: this.makeOrderRoute,
                data: {
                    price: this.currentPrice,
                    extra_card_price: this.extraCardsPrice,
                    full_name: this.name,
                    email: this.mail,
                    phone: this.phone,
                    address: this.address,
                    extern_cards: this.extra,
                    extern_cards_list: this.selectedTags,
                }
            }).then((response) => (
                this.resetForm(response)
            ))
        },

        addNewTag() {
            this.errorMessage = '';
            let selectedTag = document.getElementById("tag-search");
            if (this.selectedTags.indexOf(selectedTag.value) === -1) {
                this.selectedTags.push(selectedTag.value);
                this.extraCardsPrice += parseFloat(selectedTag.value.match(/\d+.\d+грн/)[0].replace(/[a-zа-яё]/gi, ''));
            } else {
                this.errorMessage = "This tag already exist"
            }
            selectedTag.value = null;
            this.extraCardsPrice.toFixed(2);
            console.log(this.extraCardsPrice);
        },

        removeTag(tag) {
            this.errorMessage = '';
            this.selectedTags.splice(this.selectedTags.indexOf(tag), 1);
            this.tags.sort();
            this.extraCardsPrice -= parseFloat(tag.match(/\d+.\d+грн/)[0].replace(/[a-zа-яё]/gi, ''));
            this.extraCardsPrice.toFixed(2);
        },

        resetForm(response) {
            this.currentPrice = 0;
            this.extraCardsPrice = 0;
            this.name = ''
            this.mail = ''
            this.phone = ''
            this.address = ''
            this.extra = 0
            this.selectedTags = []
        }
    }
}
</script>

<style>
input:disabled {
    background-color: #E8E9EE;
}

.fun-fact--three::before {
    background: none !important;
}

.tag-search {
    border-bottom-left-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
}

.tag-list {
    color: whitesmoke;
    background-color: #F8F8F8;
    border: 1px solid #F2F2F2;
    padding: 5px;
    border-bottom-right-radius: 5px;
    border-bottom-left-radius: 5px;
}

.tag-list:disabled {
    background-color: #E8E9EE;
    border-bottom-left-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
}

.tag {
    margin: 5px;
    padding: 5px;
    background-color: #3FCB89;
    border-radius: 5px;
}
</style>
