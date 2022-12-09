import Form from "./Form";

class Forms {
    /**
     * Create a new Forms instance.
     *
     * @param formClass
     * @returns {Array}
     */
    constructor(formClass) {
        let forms = [],
            elements = document.getElementsByClassName(formClass);

        for (let element of elements) {
            forms.push(this.initForm(element));
        }

        return forms;
    }

    /**
     * Initiate form element
     *
     * @param element
     * @returns {Form}
     */
    initForm(element) {
        let formData = new FormData(element),
            data = {};

        for (let [key, val] of formData.entries()) {
            Object.assign(data, {[key]: val});
        }

        return new Form(data);
    }
}

export default Forms;