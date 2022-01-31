<template>
    <div class="toast-container"
        :class="positionClass"
    >
        <transition-group
            name="algo"
            enter-active-class="toast--enter"
            leave-to-class="toast--leave-to"
        >
            <toast v-for="(item, key) in items"
                :key="item.uid"
                :index="key"
                :has-close-btn="item.hasCloseBtn"
                :has-icon="item.hasIcon"
                :message="item.message"
                :duration="item.duration"
                :type="item.type"
                @dismiss="dismiss"
            >
            </toast>
        </transition-group>
    </div>
</template>

<script>
    import slugify from '../../../helpers/slugify.js';
    import Toast from './Toast.vue';

    export default {
        components: { Toast },

        props: {
            /**
             * Receive an initial list of items.
             */
            initial: {
                type: Array,
                required: false,
                default: () => []
            },

            /**
             * Position of toasts. Acceptable values: 'top-right', 'top-left',
             * 'bottom-right', 'bottom-left'.
             */
            position: {
                type: String,
                required: false,
                default: 'top-right'
            }
        },

        data() {
            return {
                items: []
            };
        },

        computed: {
            positionClass: function() {
                const validPositions = ['top-right', 'top-left', 'bottom-right', 'bottom-left'];

                if (validPositions.indexOf(this.position) !== -1) {
                    return 'toast-container--' + this.position;
                }

                return 'toast-container--top-right';
            }
        },

        created() {
            this.initial.forEach(this.addItem);

            this.$root.$on('toast', this.addItem);
        },

        methods: {
            /**
             * Add the given toast to the items list.
             *
             * @param {Object} data
             */
            addItem(item) {
                if (typeof item === 'string') {
                    item = {message: item};
                }

                item.uid = Date.now() + '-' + Math.floor(Math.random() * 100000);
                this.items.push(item);
            },

            /**
             * Remove the given toast from the list.
             *
             * @param {Number} index
             */
            dismiss(index) {
                this.items.splice(index, 1);
            }
        }
    };
</script>
