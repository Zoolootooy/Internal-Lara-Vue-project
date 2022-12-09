<template>
    <b-form-checkbox
        :id="id"
        :name="name"
        size="lg"
    >
        {{ text }}
    </b-form-checkbox>
</template>

<script>
export default {
    props: ['id', 'name', 'text'],
}
</script>
