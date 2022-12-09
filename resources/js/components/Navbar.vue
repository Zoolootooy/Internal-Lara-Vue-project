<template>
    <b-navbar type="light" toggleable="xl" fixed="top" v-b-scrollspy:nav-scroller class="header-area" :class="{'is-sticky': scrolled}">
        <div class="container-fluid container-fluid--cp-150">
            <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
            <b-navbar-brand class="navbar-brand" to="/">
            </b-navbar-brand>
            <b-collapse class="default-nav justify-content-center"  is-nav id="nav_collapse">
                <b-navbar-nav class="navbar-nav main-menu">
                    <b-nav-item to="/"><span>О товаре</span></b-nav-item>
                    <b-nav-item to="/purchase"><span>Купить</span></b-nav-item>
                    <b-nav-item to="/articles"><span>Статьи</span></b-nav-item>
                    <b-nav-item to="/contact"><span>Связаться с нами</span></b-nav-item>
                </b-navbar-nav>
            </b-collapse>
        </div>
    </b-navbar>
</template>

<script>
export default {
    name:'Navbar',
    data (){
        return {
            load: false,
            limitPosition: 200,
            scrolled: false,
            lastPosition: 500,
        }
    },
    mounted (){
        (function() {
            scrollTo();
        })();

        function scrollTo() {
            const links = document.querySelectorAll('.scroll > a');
            links.forEach(each => (each.onclick = scrollAnchors));
        }

        function scrollAnchors(e, respond = null) {
            const distanceToTop = el => Math.floor(el.getBoundingClientRect().top);
            e.preventDefault();
            var targetID = (respond) ? respond.getAttribute('href') : this.getAttribute('href');
            const targetAnchor = document.querySelector(targetID);
            if (!targetAnchor) return;
            const originalTop = distanceToTop(targetAnchor);
            window.scrollBy({ top: originalTop, left: 0, behavior: 'smooth' });
            const checkIfDone = setInterval(function() {
                const atBottom = window.innerHeight + window.pageYOffset >= document.body.offsetHeight - 190;
                if (distanceToTop(targetAnchor) === 0 || atBottom) {
                    targetAnchor.tabIndex = '-1';
                    targetAnchor.focus();
                    clearInterval(checkIfDone);
                }
            }, 800);
        }
    },
    methods: {
        // sticky menu script
        handleScroll() {
            if (this.lastPosition < window.scrollY && this.limitPosition < window.scrollY) {
                this.scrolled = true;
                // move up!
            }
            if (this.lastPosition > window.scrollY) {
                this.scrolled = true;
                // move down
            }
            this.lastPosition = window.scrollY;
            this.scrolled = window.scrollY > 50;
        },

        // offcanvas searchbox
        toggleClass(addRemoveClass, className) {
            const el = document.querySelector('#search-overlay');
            if (addRemoveClass === 'addClass') {
                el.classList.add(className);
            } else {
                el.classList.remove(className);
            }
        },
    },
    created() {
        window.addEventListener("scroll", this.handleScroll);
    },
    destroyed() {
        window.removeEventListener("scroll", this.handleScroll);
    },
}
</script>
