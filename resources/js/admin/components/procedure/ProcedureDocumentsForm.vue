<template>
    <form>
        <procedure-document
            v-for="(document, i) in documents"
            :class="{'mb-6 xl:mb-4': i < documents.length - 1 }"
            :document="document"
            :form-errors="errors"
            :needs-document-validation="needsDocumentValidation"
            :key="document.id"
            @update-doc-status="(id, params) => $emit('update-doc-status', id, params)"
        >
            <template slot="check">
                <slot name="check"></slot>
            </template>
            <template slot="x">
                <slot name="x"></slot>
            </template>
        </procedure-document>

        <div v-if="hasNewRejectedDocuments && needsDocumentValidation"
            class="text-center mt-12"
        >
            <form-button class="btn--db px-16"></form-button>
        </div>
    </form>
</template>

<script>
    import BaseForm from '../../../main/components/forms/base/BaseForm.vue';
    import ProcedureDocument from './ProcedureDocument.vue';

    export default {
        extends: BaseForm,

        components: {ProcedureDocument},

        props: {
            documents: {
                type: Array,
                required: true
            },

            hasReceivedDocuments: {
                type: Boolean,
                required: true
            },

            hasNewRejectedDocuments: {
                type: Boolean,
                required: true
            },

            needsDocumentValidation: {
                type: Boolean,
                required: true
            }
        }
    };
</script>
