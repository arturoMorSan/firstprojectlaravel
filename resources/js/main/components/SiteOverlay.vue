<template>
    <div class="overlay"
        :class="{'overlay--active' : isActive}"
        @click="close"
    ></div>
</template>

<script>
    export default {
        data() {
            return {
                isActive: false,
                closeOnSwipe: false
            };
        },

        mounted() {
            this.$root.$on('closeOverlay', this.close);
            this.$root.$on('showOverlay', this.show);
            this.$root.$on('toggleOverlay', this.toggle);
        },

        methods: {
            /**
             * Hide overlay and emit the event.
             */
            close() {
                if (! this.isActive) {
                    return;
                }

                this.isActive = false;
                this.closeOnSwipe = false;

                this.$root.$emit('overlayClosed');
            },

            /**
             * Activate overlay and emit the event.
             */
            show(settings) {
                if (this.isActive) {
                    return;
                }

                for (let property in settings) {
                    this[property] = settings[property];
                }

                this.isActive = true;

                this.$root.$emit('overlayShown');
            },

            /**
             * Show or hide overlay.
             *
             * @param {boolean} show
             */
            toggle(show = true) {
                if (show) {
                    this.show();
                } else {
                    this.close();
                }
            },

        }
    };
</script>
