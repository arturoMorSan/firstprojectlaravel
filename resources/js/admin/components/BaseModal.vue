<template>
    <div v-if="isActive"
        class="base-modal"
        @click.self="closeModal"
    >
        <div class="base-modal__panel"
            ref="modal"
            tabindex="-1"
            @keyup.esc="closeModal"
        >
            <button class="base-modal__close-btn"
                @click="closeModal"
            >
                <span class="visually-hidden">Cerrar</span>
                <span aria-hidden="true">
                    <slot name="x"></slot>
                </span>
            </button>

            <slot :params="params"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            useFocusTrap: {
                type: Boolean,
                required: false,
                default: true
            },

            name: {
                type: String,
                required: false,
                default: 'base-modal'
            }
        },

        data() {
            return {
                focusTrap: null,
                isActive: false,
                params: null
            };
        },

        mounted() {
            this.$root.$on('overlayClosed', this.closeModal);
            this.$root.$on('closeModal', this.closeModal);
            this.$root.$on('showModal', this.showModal);
        },

        methods: {
            showModal(name, params = null) {
                if (name !== this.name) {
                    return;
                }

                this.isActive = true;
                this.params = params;
                this.$root.$emit('showOverlay');

                if (this.useFocusTrap) {
                    Vue.nextTick(this.setFocusTrap);
                }

                this.hook('afterShown', params);
            },

            closeModal() {
                if (! this.isActive) {
                    return;
                }

                this.isActive = false;
                this.$root.$emit('closeOverlay');

                if (this.useFocusTrap) {
                    this.destroyFocusTrap();
                }
            },


            /**
             * Call a method after verifying that it exists.
             * Useful for registering hooks for use in components that might
             * extend this one.
             *
             * @param {string} method
             * @param {mixed} params
             */
            hook(method, params = null) {
                if (typeof this[method] === 'function') {
                    this[method](params);
                }
            },

            /*
            |------------------------------------------------------------------------
            | Focustrap
            |------------------------------------------------------------------------
            */

            /*
            * Return a new instance of FocusTrap.
            */
            setFocusTrap() {
                this.focusTrap = window.FocusTrap(this.$refs.modal, {
                    escapeDeactivates: false,
                    clickOutsideDeactivates: true
                });

                this.focusTrap.activate();
            },

            /**
             * Remove the FocusTrap instance.
             */
            destroyFocusTrap() {
                this.focusTrap.deactivate();
                this.focusTrap = null;
            }
        }
    };
</script>
