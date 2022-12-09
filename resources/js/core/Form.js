import Errors from "./Errors";

class Form {
    /**
     * Create a new Form instance.
     *
     * @param data
     */
    constructor(data) {
        this.originalData = data;
        this.errors = new Errors();
        this.isSent = false;
        this.showLoader = false;
        this.reset();
    }

    /**
     * Reset the form fields.
     */
    reset() {
        for (let field in this.originalData) {
            this[field] = this.originalData[field];
        }
        //this.errors.clear();
    }

    /**
     * Fetch all relevant data for the form.
     */
    data() {
        let data = {};

        for (let field in this.originalData) {
            data[field] = this[field];
        }

        return data;
    }

    /**
     * Key down in the form field.
     * @param event
     */
    keydown(event) {
        let field = event.target.name;
        this.errors.clear(field);
    }

    /**
     * Submit the form.
     *
     * @param event
     */
    submit(event) {
        let target = event.target,
            url = target.action,
            method = target.method;

        axios[method.toLowerCase()](url, this.data())
            .then(this.success.bind(this))
            .catch(this.fall.bind(this));

        this.isSent = false;
        this.showLoader = true;
    }

    /**
     * Handle a successful form submission.
     *
     * @param response
     */
    success(response) {
        this.reset();
        this.isSent = true;
        this.showLoader = false;
    }

    /**
     * Handle a failed form submission.
     *
     * @param error
     */
    fall(error) {
        let errors = error.response.data.errors;
        this.errors.record(errors);
        this.showLoader = false;
    }
}

export default Form;