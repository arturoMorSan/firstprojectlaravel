<script>
    export default {
        props: {
            name: {
                type: String,
                required: true
            }
        },

        data() {
            return {
                icon: null
            };
        },

        computed: {
            iconName: function() {
                return this.name.replace(/(.svg$)/, '');
            }
        },

        mounted() {
            if (this.$root.iconsMap[this.iconName]) {
                return this.icon = this.$root.iconsMap[this.iconName];
            }

            this.icon = this.createHtml();

            this.$set(this.$root.iconsMap, this.iconName, this.icon);
        },

        methods: {
            createHtml() {
                const div = document.createElement('div');
                div.innerHTML = require('../../../svg/' + this.iconName + '.svg');

                let fragment = document.createDocumentFragment();
                fragment.appendChild(div);

                return fragment.querySelector('svg').outerHTML;
            }
        },

        render(h) {
            return h('svg', {
                domProps: {
                    outerHTML: this.icon
                }
            });
        }
    };
</script>
