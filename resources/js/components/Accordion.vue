<template>
    <div class="accordion-faq wow move-up">
        <b-card no-body v-for="(element, index) in elements" :key="element.id">
            <b-card-header header-tag="header">
                <b-button block v-b-toggle="'accordion-' + element.id" class="faq-title">{{ element.name }} </b-button>
            </b-card-header>
            <b-collapse :id="'accordion-' + element.id"  accordion="my-accordion">
                <b-card-body>
                    <b-card-text v-html="element.description">
                    </b-card-text>
                </b-card-body>
            </b-collapse>
        </b-card>
    </div>
</template>

<script>
    export default {
        name: 'Accordion',
        props: ['elements'],
    };
</script>

<style>
    .faq-wrapper {
        line-height: 1.74;
        font-size: 15px;
        font-style: normal;
        font-weight: 400;
        visibility: visible;
        font-family: Rubik, Helvetica, Arial, sans-serif;
        color: #7e7e7e;
    }

    .accordion-faq .card-header [aria-expanded="true"]:before {

    }
</style>
