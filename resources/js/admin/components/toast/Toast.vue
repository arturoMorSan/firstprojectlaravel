<template>
    <div class="toast shadow-lg"
        :class="['toast--' + type, {
            'toast--has-icon' : hasIcon
        }]"
        aria-atomic="true"
        :aria-live="type === 'danger' ? 'assertive' : 'polite'"
        :role="type === 'danger' ? 'alert' : 'status'"
    >
        <p class="mb-0 w-full">
            {{ message }}
        </p>

        <button v-if="hasCloseBtn"
            class="toast__btn"
            type="button"
            @click="$emit('dismiss', index)"
        ></button>

        <span v-if="duration"
            class="toast__progress"
            :style="'animation: toast-progress '+ duration +'s linear forwards'"
        ></span>
    </div>
</template>

<script>
    import {slideUp} from '../../../helpers/animation/slide.js';

    export default {
        props: {
            /**
             * Key of the toast element in the container object.
             */
            index: {
                type: Number,
                required: true
            },

            /**
             * Number of seconds for the toast to be visible.
             * Set to 0 for unlimited time.
             */
            duration: {
                type: Number,
                required: false,
                default: 5
            },

            /**
             * Show a close button.
             */
            hasCloseBtn: {
                type: Boolean,
                required: false,
                default: true
            },

            /**
             * Define if a status icon is displayed with the message.
             */
            hasIcon: {
                type: Boolean,
                required: false,
                default: true
            },

            /**
             * Text to show.
             */
            message: {
                type: String,
                required: true
            },

            /**
             * Type modifier.
             */
            type: {
                type: String,
                required: false,
                default: 'success'
            }
        },

        /**
         * Set automatic dismiss timer.
         */
        mounted() {
            if (! this.duration) {
                return;
            }

            setTimeout(() => {
                this.$el.style.height = this.$el.offsetHeight + 'px';
                this.$emit('dismiss', this.index);
            }, this.duration * 1000);
        }
    };
</script>
