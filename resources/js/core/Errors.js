class Errors {
    /**
     * Create a new Errors instance.
     */
    constructor() {
        this.list = {};
    }

    /**
     * Determine if an errors exists for the given field.
     *
     * @param {string} field
     * @returns {boolean}
     */
    has(field) {
        return this.list.hasOwnProperty(field);
    }

    /**
     * Determine if there are any errors.
     *
     * @returns {boolean}
     */
    any() {
        return Object.keys(this.list).length > 0;
    }

    /**
     * Retrieve the error message for a field.
     *
     * @param {string} field
     * @returns {*}
     */
    get(field) {
        if (this.list[field]) {
            return this.list[field][0];
        }
    }

    /**
     * Record the new errors.
     *
     * @param {object} list
     */
    record(list) {
        this.list = list;
    }

    /**
     * Clear one or all error fields.
     *
     * @param {string|null} field
     */
    clear(field) {
        if (field) {
            delete this.list[field];
            return;
        }

        this.errors = {};
    }
}

export default Errors;