import '../boot.js';
import BaseModal from "./components/BaseModal.vue";
import BaseForm from '../main/components/forms/base/BaseForm.vue';
import DashboardMenu from './components/dashboard-menu/DashboardMenu.vue';
import DeleteButton from './components/DeleteButton.vue';
import DraggableResourceForm from './components/DraggableResourceForm.vue';
import DraggableTable from './components/DraggableTable.vue';
import GalleryCard from '../main/components/GalleryCard.vue';
import GalleryPanel from './components/GalleryPanel.vue';
import ProfileForm from './components/forms/ProfileForm.vue';
import UserForm from './components/forms/UserForm.vue';
import ProfileGalleryCard from '../main/components/ProfileGalleryCard.vue';
import ResourceTable from './components/ResourceTable.vue';
import Tabs from '../main/components/tabs/Tabs.vue';
import UserBar from './components/UserBar.vue';
import Vuedraggable from 'vuedraggable';
import TruncatedText from '../main/components/TruncatedText.vue';
import Toasts from './components/toast/Toasts.vue';
import SiteOverlay from '../main/components/SiteOverlay.vue';

(function() {
    /* Base components
    ------------------------------------------------------------------------- */
    Vue.component('base-form', BaseForm);
    Vue.component('base-modal', BaseModal);

    Vue.component('gallery-card', GalleryCard);
    Vue.component('profile-gallery-card', ProfileGalleryCard);

    /* Dashboard components
    ------------------------------------------------------------------------- */

    Vue.component('delete-button', DeleteButton);
    Vue.component('resource-table', ResourceTable);
    Vue.component('tabs-component', Tabs);
    Vue.component('draggable', Vuedraggable);
    Vue.component('draggable-resource-form', DraggableResourceForm);
    Vue.component('draggable-table', DraggableTable);
    Vue.component('gallery-panel', GalleryPanel);
    Vue.component('truncated-text', TruncatedText);
    Vue.component('site-overlay', SiteOverlay);
    /* Single use components
    ------------------------------------------------------------------------- */
    Vue.component('profile-form', ProfileForm);
    Vue.component('user-form', UserForm);
    Vue.component('table-accordion', TableAccordion);
    Vue.component('toasts', Toasts);

    const vm = new Vue({
        el: '#dashboard',
        components: { DashboardMenu, UserBar },
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
