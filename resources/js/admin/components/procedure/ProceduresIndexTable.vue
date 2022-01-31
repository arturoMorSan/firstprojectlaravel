<template>
    <table class="table table-index">
        <slot :list="list" :mobile-view="mobileView"></slot>
    </table>
</template>

<script>
    import IndexTable from '../IndexTable.vue';

    export default {
        extends: IndexTable,

        methods: {
            getStatus: function(keyname) {
                const dict = {
                    'new': 'Nuevo',
                    'attachments-validation': 'Revisión de documentos',
                    'attachments-pending': 'En espera de documentos',
                    'payment-pending': 'En espera de pago',
                    'paid': 'Pagado',
                    'documents-pending': 'En espera de fotografías',
                    'documents-received': 'Fotografías recibidas',
                    'signatures': 'En firmas',
                    'delivering': 'Por entregar',
                    'finished': 'Concluido',
                    'cancelled': 'Rechazado'
                };

                return dict[keyname];
            },

            needsAttention: function(status) {
                const attendableStatuses = ['new', 'attachments-validation', 'paid', 'documents-received'];

                return attendableStatuses.indexOf(status) !== -1;
            }
        }
    };
</script>
