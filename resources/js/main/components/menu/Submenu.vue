<template>
    <li class="main-menu__li"
        @mouseover="onMouseOver"
        @mouseleave="onMouseLeave"
    >
        <p class="main-menu__submenu-title"
            :class="{'main-menu__submenu-title--active': isActive && ! breakpointMatches}"
            tabindex="0"
            aria-haspopup="true"
            :aria-expanded="isActive ? 'true' : 'false'"
            ref="title"
            @click="toggle"
            @keydown.left.right.prevent="onLeftRightKeys"
            @keydown.up.down.prevent="onUpDownKeys"
            @keydown.space.enter.prevent="toggle"
            @blur="onBlur"
        >
            <slot></slot>
        </p>

        <ul class="list-bare main-menu__submenu" ref="submenu">
            <site-submenu-link v-for="(link, name) in links" :key="name"
                :name="name"
                :link-data="$parent.parseLink(link)"
            >
            </site-submenu-link>
        </ul>
    </li>
</template>

<script>
    import { slideUp, slideDown } from '../../../helpers/animation/slide.js';
    import SiteSubmenuLink from './SubmenuLink.vue';

    export default {
        components: { SiteSubmenuLink },

        props: {
            breakpointMatches: {
                type: Boolean,
                required: true
            },
            links: {
                type: Object,
                required: true
            }
        },

        data() {
            return {
                isActive: false,
                submenuLinks: [],
                css: {
                    submenuLink: 'main-menu__submenu-link'
                }
            };
        },

        computed: {
            isLast: function() {
                const index = Array.prototype.indexOf.call(this.$parent.menuItems, this.$refs.title);

                return index === this.$parent.menuItems.length - 1;
            }
        },

        watch: {
            isActive: function(value) {
                if (this.breakpointMatches) {
                    this.$refs.submenu.style.display = '';

                    return;
                }

                if (value) {
                    slideDown(this.$refs.submenu);
                } else {
                    slideUp(this.$refs.submenu);
                }
            }
        },

        mounted() {
            this.submenuLinks = this.$el.querySelectorAll('.' + this.css.submenuLink);

            this.$parent.$on('resetSubmenus', this.close);
            this.$parent.$on('focusLastSubmenuLink', this.focusLastLink);
        },

        methods: {
            /**
             * Set submenu as active on desktop view when mouse enters the submenu.
             */
            onMouseOver() {
                if (this.breakpointMatches) {
                    this.isActive = true;
                }
            },

            /**
             * Set submenu as inactive on desktop view when mouse leaves the submenu.
             */
            onMouseLeave() {
                this.closeIfBreakpoint();
            },


            /*
            |------------------------------------------------------------------------
            | Visibility
            |------------------------------------------------------------------------
            */

            /**
             * Close submenu.
             */
            close() {
                this.isActive = false;
            },

            /**
             * Close submenu only if breakpoint matches.
             */
            closeIfBreakpoint() {
                if (this.breakpointMatches) {
                    this.isActive = false;
                }
            },

            /**
             * Show or hide submenu.
             */
            toggle() {
                this.isActive = ! this.isActive;
            },


            /*
            |------------------------------------------------------------------------
            | Focus
            |------------------------------------------------------------------------
            */

            /**
             * Focus the last link in submenu if the given HTML element matches
             * the title of the component.
             *
             * @param {HTMLElement} title
             */
            focusLastLink(title) {
                if (this.$refs.title === title) {
                    this.isActive = true;

                    // Wait for the element to be visible (nextTick is not enough)
                    setTimeout(() => {
                        this.submenuLinks[this.submenuLinks.length - 1].focus();
                    }, 50);
                }
            },

            /**
             * Hide submenus when focus moves to a new menu item
             * on desktop screens.
             *
             * @param {Object} e
             */
            onBlur(e) {
                if (! this.breakpointMatches) {
                    return;
                }

                Vue.nextTick(() => {
                    if (this.submenuLinks[0] !== document.activeElement) {
                        this.close();
                    }
                });
            },


            /*
            |------------------------------------------------------------------------
            | Keyboard navigation
            |------------------------------------------------------------------------
            */

            /**
             * Navigate through submenu links with "up" and "down" arrows.
             *
             * @param {Object} e
             */
            linkNavigation(e) {
                const index = Array.prototype.indexOf.call(this.submenuLinks, e.target);
                const siblingLink = this.submenuLinks[e.key === 'ArrowUp' ? index - 1 : index + 1];

                if (siblingLink) {
                    return siblingLink.focus();
                }

                if (e.key === 'ArrowUp') {
                    return this.$refs.title.focus();
                }

                this.$parent.focusSiblingItem(this.$refs.title, 'next');

                if (! this.isLast) {
                    this.closeIfBreakpoint();
                }
            },

            /**
             * Move to previous or next menu item when left or right keys are pressed.
             *
             * @param {Object} e
             */
            onLeftRightKeys(e) {
                this.$parent.arrowNavigation({
                    target: this.$refs.title,
                    key: e.key
                });
            },

            /**
             * When the focus is on a submenu title, move to first link in submenu
             * with "down" key, or to the previous focusable item with "up" key
             * (another menu item or submenu link).
             *
             * @param {Object} e
             */
            onUpDownKeys(e) {
                if (e.key === 'ArrowUp') {
                    return this.$parent.focusPreviousElement(this.$refs.title);
                }

                this.isActive = true;

                // Wait for the element to be visible (nextTick is not enough)
                setTimeout(() => {
                    this.submenuLinks[0].focus();
                }, 50);
            }
        }
    };
</script>
