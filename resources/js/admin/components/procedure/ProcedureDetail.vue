<template>
    <div class="row">
        <modal-cancel
            v-if="canBeCancelled"
            :procedure-id="attendee.id"
        >
            <template slot="x">
                <slot name="x"></slot>
            </template>
        </modal-cancel>

        <div class="col lg:col-2/3">
            <div class="db-panel">
                <h2 class="db-panel__title">
                    Proyecto : {{ attendee.project_name }}
                </h2>

                <div class="row">
                    <p class="col md:col-1/2 lg:col-1/3">
                        <span class="db-term">Nombre</span>
                        {{ attendee.full_name }}
                    </p>

                    <p class="col md:col-1/2 lg:col-1/3 md:mr-0">
                        <span class="db-term">Carrera</span>
                        {{ attendee.career }}
                    </p>

                    <p class="col md:col-1/2 lg:col-1/3 md:mr-0 lg:mr-gutter">
                        <span class="db-term">Cuatrimestre</span>
                        {{ attendee.quarter }}
                    </p>

                    <p class="col md:col-1/2 lg:col-1/3">
                        <span class="db-term">Correo electrónico</span>
                        {{ attendee.email }}
                    </p>
                    <p class="col md:col-1/2 lg:col-1/3">
                        <span class="db-term">Tipo de usuario</span>
                        {{ attendee.type_assistant }}
                    </p>
                    <p class="col md:col-1/2 lg:col-1/3">
                        <span class="db-term">Convocatoria</span>
                        {{ attendee.call.title }}
                    </p>
                </div>
            </div>

            <div class="db-panel">
                <h2 class="db-panel__title">
                    Documentos
                </h2>

                <p v-if="hasReceivedDocuments && needsDocumentValidation" class="mb-8">
                    Valida que la documentación entregada para el proyecto. En caso de que un documento no cumpla con los requisitos, se le pedirá al participante volver a adjuntarlo.
                </p>

                <procedure-documents-form
                    :action="$root.path + '/admin/ponente/' + attendee.id + '/rechazar-documentos'"
                    :documents="normalizedDocuments"
                    :has-received-documents="hasReceivedDocuments"
                    :has-new-rejected-documents="hasNewRejectedDocuments"
                    :needs-document-validation="needsDocumentValidation"
                    @update-doc-status="updateDocStatus"
                >
                    <template slot="check">
                        <slot name="check"></slot>
                    </template>
                    <template slot="x">
                        <slot name="x"></slot>
                    </template>
                </procedure-documents-form>
            </div>
        </div>
         <div class="col lg:col-1/3">
            <procedure-activity
                :all-documents-approved="allDocumentsApproved"
                :can-be-cancelled="canBeCancelled"
                :procedureId="attendee.id"
                :status="attendee.status.key_name"
                @statuschange="newStatus => status = newStatus"
            ></procedure-activity>
        </div>
    </div>
</template>

<script>
    import ModalCancel from './ModalCancel.vue';
    import ProcedureActivity from './ProcedureActivity.vue';
    import ProcedureDocumentsForm from './ProcedureDocumentsForm.vue';

    export default {
        components: {
            ModalCancel,
            ProcedureActivity,
            ProcedureDocumentsForm
        },

        props: {
            attendee: {
                type: Object,
                required: true
            },

            documents: {
                type: Array,
                required: false,
                default: []
            },
        },

        data() {
            return {
                normalizedDocuments: [],
                status: this.attendee.status.key_name,

            };
        },

        computed: {
            /**
             * Check if all documents are approved.
             *
             * @return {Boolean}
             */
            allDocumentsApproved: function() {
                return ! this.normalizedDocuments.filter(doc =>
                    ! (doc.status === 'approved' || doc.newStatus === 'approved')
                ).length;
            },

            /**
             * Determine if the procedure can be cancelled according
             * to it's current status.
             *
             * @return {Boolean}
             */
            canBeCancelled: function() {
                const cancellableStatuses = [
                    'new'
                ];

                return cancellableStatuses.indexOf(this.status) !== -1;
            },


            /**
             * Check if the procedure has newly uploaded documents.
             *
             * @return {Boolean}
             */
            hasReceivedDocuments: function() {
                return !! this.documents.filter(doc =>
                    doc.status.key_name === 'new'
                ).length;
            },

            /**
             * Check if there are newly uploaded documents
             * that are being rejected.
             *
             * @return {Boolean}
             */
            hasNewRejectedDocuments: function() {
                return !! this.normalizedDocuments.filter(doc =>
                    doc.newStatus === 'rejected'
                ).length;
            },

            /**
             * Determine if the procedure has been concluded
             * (it was attended or cancelled).
             *
             * @return {Boolean}
             */
            isComplete: function() {
                const completeStatuses = ['finished', 'cancelled'];

                return completeStatuses.indexOf(this.status) !== -1;
            },

            /**
             * Check if procedure status requires document validation.
             *
             * @return {Boolean}
             */
            needsDocumentValidation: function() {
                const statuses = ['new', 'attachments-validation'];

                return statuses.indexOf(this.status) !== -1 && this.hasReceivedDocuments;
            }
        },

        created() {
            this.normalizeDocuments();
        },

        methods: {
            /**
             * Return the extension for the given file url.
             *
             * @param  {string} url
             * @return {string}
             */
            getFileExtension: function(url) {
                return url.split('.').pop().toLowerCase();
            },

            /**
             * Check if the given status is the same or comes before
             * the current one.
             *
             * @param  {string}  status
             * @return {Boolean}
             */
            isPreviousOrSameStatus: function(status) {
                return this.status === status || this.isPreviousStatus(status);
            },

            /**
             * Check if the given status comes before the current one.
             *
             * @param  {string}  status
             * @return {Boolean}
             */
            isPreviousStatus: function(status) {
                const currentIndex = this.statusesKeys.indexOf(this.status);
                const searchedIndex = this.statusesKeys.indexOf(status);

                return searchedIndex < currentIndex;
            },

            /**
             * Update the `newStatus` attribute when rejecting or approving
             * a document.
             *
             * @param  {number} id
             * @param  {string} status
             */
            updateDocStatus(id, status) {
                const docIndex = this.normalizedDocuments.findIndex(doc => doc.id === id);

                this.$set(this.normalizedDocuments[docIndex], 'newStatus', status);
            },


            /*
            |-------------------------------------------------------------------
            | Normalizers
            |-------------------------------------------------------------------
            */

            /**
             * Normalize the list of received documents and their properties.
             */
            normalizeDocuments() {
                const icons = {
                    doc: 'doc',
                    docx: 'doc',
                    gif: 'img',
                    jpeg: 'img',
                    jpg: 'img',
                    pdf: 'pdf',
                    png: 'img',
                    xls: 'xls',
                    xlsx: 'xls',
                    zip: 'zip'
                };

                this.documents.forEach(doc => {
                    this.normalizedDocuments.push({
                        id: doc.id,
                        name: doc.document_type.name,
                        status: doc.status.key_name,
                        newStatus: null,
                        url: doc.url_document,
                        icon: icons[this.getFileExtension(doc.url_document)] || 'doc-download',
                        rejections: doc.rejections
                    });
                });
            }
        }
    };
</script>
