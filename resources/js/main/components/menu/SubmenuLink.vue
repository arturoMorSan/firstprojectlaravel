<template>
    <li class="main-menu__submenu-item">
        <a class="main-menu__submenu-link" :href="linkData.url"
            :target="linkData.newTab ? '_blank' : false"
            :rel="linkData.newTab && linkData.external ? 'noopener noreferrer' : false"
            ref="link"
            @keydown.up.down.prevent="$parent.linkNavigation"
            @keydown.left.right.prevent="onLeftRightKeys"
            @keydown.tab="onTab"
        >
            {{ name }}
        </a>
    </li>
</template>

<script>
    export default {
        props: {
            linkData: {
                type: Object,
                required: true
            },
            name: {
                type: String,
                required: true
            }
        },

        computed: {
            isLast: function() {
                const index = Array.prototype.indexOf.call(this.$parent.submenuLinks, this.$refs.link);

                return index === this.$parent.submenuLinks.length - 1;
            }
        },

        methods: {
            /**
             * Move to the current or next menu item with "left" and "right" arrows.
             *
             * @param {Object} e
             */
            onLeftRightKeys(e) {
                if (e.key === 'ArrowLeft') {
                    return this.$parent.$refs.title.focus();
                }

                this.$parent.onLeftRightKeys(e);

                if (! this.$parent.isLast) {
                    this.$parent.closeIfBreakpoint();
                }
            },

            /**
             * Pressing tab while the focus is on the last link of a submenu
             * will deactivate that submenu on desktop view.
             *
             * @param {Object} e
             */
            onTab(e) {
                if (this.isLast && ! e.shiftKey) {
                    this.$parent.closeIfBreakpoint();
                }
            }
        }
    };
</script>
