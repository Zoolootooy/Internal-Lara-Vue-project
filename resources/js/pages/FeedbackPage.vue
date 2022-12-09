<template>
    <div class="main-container">
        <ContactForm :feedbackRoute="feedbackRoute"/>
    </div>
</template>

<script>
import ContactForm from '../components/ContactForm';

export default {
    name: "FeedbackPage",
    props: ['feedbackRoute'],
    components: {
        ContactForm,
    },
}
</script>

<style scoped>

</style>
