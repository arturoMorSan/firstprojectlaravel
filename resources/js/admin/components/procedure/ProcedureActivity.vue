<template>
    <div>
        <div class="db-panel">
        <h2 class="db-panel__title">
            Estado
        </h2>

        <p>
            <strong>Estado:</strong>
            <span v-if="status == 'new'">Enviado</span>
            <span v-if="status == 'approved'">Aceptado</span>
            <span v-if="status == 'rejected'">Cancelado</span>
            <span v-if="status == 'attachments-pending'">Corregir documentos</span>
            <span v-if="status == 'attachments-validation'">Validación de documentos</span>
        </p>
    </div>
    <div v-if="(status === 'new' || status === 'attachments-validation') && allDocumentsApproved" class="db-panel">
        <h2 class="db-panel__title">
            Aceptar
        </h2>

        <p>
            <strong>Aceptar proyecto</strong>
        </p>
        <p class="mb-8">
            Has aprobado todos los documentos del proyecto. Aprueba al participante para continuar con el proceso.
        </p>

        <div class="text-center">
            <button
                class="btn btn--db px-8 mb-2"
                :class="{'btn--loading': acceptedSpeaker}"
                type="button"
                @click="AcceptSpeaker"
            >Aceptar proyecto</button>
        </div>
    </div>
    <div v-if="canBeCancelled" class="db-panel">
        <h2 class="db-panel__title">
            Cancelar / Rechazar
        </h2>

        <p>
            <strong>Rechazar proyecto</strong>
        </p>
        <p>
            Rechaza la solicitud en caso de que sea una solicitud errónea. Se notificará al participante por correo electrónico. Esta acción es irreversible.
        </p>

        <div class="text-center mt-8">
            <button class="btn btn--danger btn--wide"
                @click="$root.$emit('showModal', 'cancel-procedure', {comment: temporaryCancelComment})"
            >Rechazar proyecto</button>
        </div>
    </div>
    </div>

</template>

<script>
    export default {
        props: {
            allDocumentsApproved: {
                type: Boolean,
                required: true
            },

            canBeCancelled: {
                type: Boolean,
                required: true
            },

            procedureId: {
                type: Number,
                required: true
            },

            status: {
                required: true,
                type: String
            },
        },

        data() {
            return {
                paymentLinkError: '',
                acceptedSpeaker: false,
                showingStatusSelect: false,
                statuses: [],
                temporaryCancelComment: '',
            }
        },

        computed: {
            /**
             * Return the log entry for when the procedure was cancelled.
             *
             * @return {Object}
             */
            cancelledLogEntry: function() {
                const status = this.computedLog.filter(item => item.status === 'cancelled');

                if (! status.length) {
                    return {};
                }

                return status[status.length - 1];
            },

            /**
             * The current status dictionary containing template text.
             *
             * @return {Object}
             */
            currentStatus: function() {
                return this.statuses.find(el => el.key === this.status);
            }
        },

        created() {
            this.$root.$on('ModalCancelComment', comment => this.temporaryCancelComment = comment);
        },

        methods: {
            /**
             * Determine if given status should be available to select/update.
             *
             * @param  {string}  status
             * @return {Boolean}
             */
            isAvailableStatus: function(status) {
                const currentIndex = this.statusesKeys.indexOf(this.status);
                const expectedIndex = this.statusesKeys.indexOf(status);

                return expectedIndex === currentIndex + 1 ||
                    currentIndex === expectedIndex;
            },

            /**
             * Make POST request for sending the payment link.
             */
            AcceptSpeaker: function() {
                const procedureUrl = this.$root.path + '/admin/ponente/' + this.procedureId;

                this.acceptedSpeaker = true;
                this.paymentLinkError = '';

                axios.post(procedureUrl + '/aceptar')
                .then(response => {
                    if (response.headers['redirect-to']) {
                        return window.location.href = response.headers['redirect-to'];
                    }
                })
                .catch(error => {
                    this.acceptedSpeaker = false;

                    if (error.response.status === 422) {
                        this.paymentLinkError = error.response.data.errors.global;
                    }
                });
            }
        }
    };
</script>
