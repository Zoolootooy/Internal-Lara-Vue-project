import Modal from '../components/Modal';
import Slug from '../components/Slug';
import Search from '../components/Search';

new Vue({
    el: '#app',

    components: {
        Modal,
        Slug,
        Search,
    },

    data: {
        showModal: false
    },

    methods: {
        confirmDelete(event) {
            event.preventDefault();

            let action = event.target.href,
                form = document.getElementById('delete-form'),
                message = form.getAttribute('data-message');

            if (confirm(message)) {
                form.action = action;
                form.submit();
            }
        }
    }
});