<template>
    <div class="contact-form-section section-space--ptb_120" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 order-2 order-lg-1">
                    <div class="section-title text-left section-space--mb_60">
                        <h2 class="font-weight--bold mb-15 wow move-up">Свяжитесь с нами!</h2>
                        <span class="section-text_left wow move-up">Дайте нам знать, что вы думаете о товаре.</span>
                        <p class="alert alert-success" role="alert" v-if="success">{{ successMessage }}</p>
                    </div>
                    <div class="contact-from-wrapper wow move-up">
                        <form id="contactForm" @submit.prevent="submitForm">
                            <input type="hidden" name="_token" :value="csrf">
                            <div class="contact-page-form">
                                <div class="contact-input">
                                    <div class="contact-inner">
                                        <input name="sender_name" type="text" placeholder="Имя *" required>
                                    </div>
                                    <div class="contact-inner">
                                        <input name="sender_email" type="email" placeholder="Email *" required>
                                    </div>
                                </div>
                                <div class="contact-inner">
                                    <input name="subject" type="text" placeholder="Тема *" required>
                                </div>
                                <div class="contact-inner contact-message">
                                    <textarea name="body" placeholder="Сообщение *" required></textarea>
                                </div>
                                <div class="contact-submit-btn">
                                    <button class="ht-btn ht-btn-md" type="submit" v-if="showButton">Отправить сообщение</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 order-1 order-lg-2">
                    <div class="peatures_image-wrap section-space--mb_40">
                        <div class="image text-center wow move-up">
                            <img class="img-fluid" src="../../img/features/aeroland-contact-form-image-01.png"
                                 alt="contact thumb">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: 'ContactForm',
    props: ['feedbackRoute'],
    data: function () {
        return {
            success: false,
            showButton: true,
            successMessage: 'Сообщение успешно отправлено!',
        }
    },
    computed: {
        csrf() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        },
    },
    methods: {
        submitForm() {
            const axios = require('axios').default;
            this.showButton = false;
            let form = new FormData(contactForm);
            contactForm.reset();
            axios({
                method: 'post',
                url: this.feedbackRoute,
                data: form,
            }).then((response) => (
                this.showSuccessMessage(response)
            ))
        },

        showSuccessMessage(response) {
            if (response.data) {
                this.success = true;
                this.showButton = true;
                setTimeout(() => this.success = false, 4000);
            }
        }
    }
}
</script>
