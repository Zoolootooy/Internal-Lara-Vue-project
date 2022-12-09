<template>
    <div class="relative z-50 w-full max-w-xs">
        <div class="relative">
            <div class="relative position-relative">
                <span class="bx bx-search-alt"></span>
                <input dusk="global-search"
                    ref="input"
                    @input.stop="search"
                    @keydown.esc.stop="closeSearch"
                    @keydown.down.prevent="move(1)"
                    @keydown.up.prevent="move(-1)"
                    @focus="openSearch"
                    v-model="query"
                    type="search"
                    :placeholder="'Global search'"
                    class="pl-search w-full form-control form-global-search" />
                <span class="bx bx-search-alt"></span>
            </div>
            <div v-if="loading" class="bg-white text-center py-3 overflow-hidden absolute rounded-lg shadow-lg w-full mt-2 max-h-search overflow-y-auto absolute">
                Querying...
            </div>
            <div v-if="resultsKeys.length" class="overflow-hidden search-results-container absolute rounded-lg shadow-lg w-full mt-2 max-h-search overflow-y-auto" ref="container">
                <div v-for="group in resultsKeys">
                    <h3 class="text-xs uppercase search-results-container__group tracking-wide text-80 bg-40 py-2 px-3">
                        {{ group }}
                    </h3>
                    <ul class="list-reset">
                        <li v-for="(item, index) in groupedItems(group)" :key="index" class="js-test">
                            <div>
                                <a :dusk="item.resourceName + ' ' + item.index" :href="item.route">
                                    <p class="text-90">{{ item.title }}</p>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import _ from 'lodash';

    export default {

        data: () => ({
            loading: false,
            searching: false,
            query: '',
            results: [],
            highlighted: 0,
        }),

        watch: {
            $route: function () {
                this.closeSearch()
            },
        },

        methods: {
            /*isNotInputElement(event) {
                const tagName = event.target.tagName
                return Boolean(tagName !== 'INPUT'
                    && tagName !== 'TEXTAREA')
            },*/

            openSearch() {
                //this.clearSearch()
                this.$refs.input.focus()
                this.searching = true
                this.clearResults()
            },

            closeSearch() {
                this.clearSearch()
                this.clearResults()
                this.$refs.input.blur()
                this.searching = false
                this.loading = false
            },

            clearSearch() {
                this.query = ''
            },

            clearResults() {
                this.results = []
            },

            search(event) {
                this.highlighted = 0
                this.loading = true

                if (this.query === '') {
                    this.loading = false
                    this.results = []
                } else {
                    this.fetchResults(event.target.value)
                }
            },

            async fetchResults(query) {
                this.results = []

                if (query !== '') {
                    try {
                        const results = await axios.get('/api/search', {params: { query }})
                        this.results = results.data
                        this.loading = false
                    } catch (e) {
                        this.loading = false
                        throw e
                    }
                }
            },

            groupedItems(key) {
                return Object.values(this.results[key]);
            },

            move(offset) {
                if (this.resultsKeys.length) {
                    this.$refs.container.scrollBy(0, offset === 1 ? 50 : -50);
                }
            },
        },

        computed: {
            hasResults() {
                return this.results.length > 0
            },

            resultsKeys() {
                return Object.keys(this.results);
            },

            resultsValues() {
                return Object.values(this.results);
            },

            hasQuery() {
                return this.query !== ''
            },

            showNoResults() {
                return (
                    this.searching
                    && !this.loading
                    && !this.hasResults
                    && this.hasQuery
                )
            },

            showResults() {
                return this.searching
                    && this.hasResults
                    && !this.loading
            },

            indexedResults() {
                return _.map(this.results, (item, index) => {
                    return { index, ...item }
                })
            },
        },
    }
</script>