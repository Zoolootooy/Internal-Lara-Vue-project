<script>
    export default {
        props: ['value'],

        data() {
            return {
                slug: this.value
            }
        },

        methods: {
            change(event) {
                let target = event.target;

                if (this.slug == null || this.slug == '' || target.id == 'slug') {
                    this.update(target.value);
                }
            },

            update(slug) {
                this.slug = slug.toString().toLowerCase().replace(/ /g, '-').replace(/ˆ-+|-+$/g, '');
            }
        }
    }
</script>