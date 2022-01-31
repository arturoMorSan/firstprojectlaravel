import '../boot.js';
import BaseForm from './components/forms/base/BaseForm.vue';
import ContactForm from './components/forms/ContactForm.vue';
import Menu from './components/menu/Menu.vue';
import SiteOverlay from './components/SiteOverlay.vue';
import GalleryCard from './components/GalleryCard.vue';
import GalleryLink from './components/GalleryLink.vue';
import UserBar from '../admin/components/UserBar.vue';
import TruncatedText from './components/TruncatedText.vue';
import AttendeesForm from './components/forms/attendees/AttendeesForm.vue';
import DocumentForm from './components/forms/DocumentForm.vue';
import Tabs from './components/tabs/Tabs.vue';

import Toasts from '../admin/components/toast/Toasts.vue';


(function() {
    /* Base components
    ------------------------------------------------------------------------- */
    Vue.component('base-form', BaseForm);
    Vue.component('contact-form', ContactForm);
    Vue.component('attendees-form', AttendeesForm);
    Vue.component('document-form', DocumentForm);


    /* App components
    ------------------------------------------------------------------------- */
    Vue.component('site-menu', Menu);
    Vue.component('site-overlay', SiteOverlay);
    Vue.component('gallery-card', GalleryCard);
    Vue.component('gallery-link', GalleryLink);

    Vue.component('truncated-text', TruncatedText);
    Vue.component('tabs-component', Tabs);
    Vue.component('toasts', Toasts);

    /**
     * Vue instance
     */
    const app = new Vue({
        el: '#app',
        components: { UserBar },
        data: {
            isLoading: true,
            path: document.body.getAttribute('data-root') || '',
            menuIsVisible: false,
            mq: false,
            resourceCount: 0,
            model: {}
        },
        mounted() {
            this.mq = window.matchMedia('(min-width:1100px)');
            this.menuIsVisible = this.mq.matches;

            this.mq.addListener(e => this.menuIsVisible = e.matches);

            Vue.nextTick(() => this.isLoading = false);
        },

        methods: {
            /**
             * Show or hide dashboard menu.
             */
            toggleMenu() {
                this.menuIsVisible = ! this.menuIsVisible;
            }
        }
    });



})();
