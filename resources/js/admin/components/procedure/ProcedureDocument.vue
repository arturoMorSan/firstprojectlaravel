<template>
    <div>

        <div class="row items-start">
            <p class="w-full lg:w-auto">
                <a :href="$root.path + '/admin/consultar-documento/' + document.id +'/'" target="_blank">
                    <span class="svg-w-8 mr-2" aria-hidden="true">
                        </span>{{ document.name }}</a>

                <span v-if="document.status === 'approved'"
                    class="tag tag--success ml-2"
                >Aprobado</span>

                <span v-if="document.status === 'rejected'"
                    class="tag tag--danger ml-2"
                >Rechazado</span>
            </p>

            <div class="lg:ml-auto w-full lg:w-auto">
                <div v-if="document.status === 'new' && needsDocumentValidation"
                    class="document-action__container"
                >
                    <div class="document-action mr-2">
                        <input
                            :id="controlId + '-approve'"
                            v-model="$parent.fields[controlName]"
                            type="radio"
                            value="approved"
                            :aria-invalid="fieldErrors.length ? 'true' : null"
                            :aria-describedBy="fieldErrors.length ? controlId + '-errors' : null"
                            @change="atStatusChange(document.id, 'approved')"
                        >

                        <label class="btn document-action__btn document-action__btn--approve"
                            :for="controlId + '-approve'"
                        >
                            <span class="svg-w-6 mr-2" aria-hidden="true">
                                <slot name="check"></slot>

                            </span>

                            Aprobar
                        </label>
                    </div>

                    <div class="document-action">
                        <input
                            :id="controlId + '-reject'"
                            v-model="$parent.fields[controlName]"
                            type="radio"
                            value="rejected"
                            :aria-invalid="fieldErrors.length ? 'true' : null"
                            :aria-describedBy="fieldErrors.length ? controlId + '-errors' : null"
                            @change="atStatusChange(document.id, 'rejected')"
                        >

                        <label class="btn document-action__btn document-action__btn--reject"
                            :for="controlId + '-reject'"
                        >
                        <slot name="x-button"></slot>
                            <span class="svg-w-6 mr-2" aria-hidden="true">
                                <slot name="x"></slot>
                            </span>
                            Rechazar
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <ul v-if="fieldErrors.length"
            :id="controlId + '-errors'"
            class="error"
        >
            <li v-for="(error, i) in fieldErrors"
                :key="i"
                v-text="error"
            ></li>
        </ul>

        <div class="form-control mt-4"
            ref="commentControl"
            style="display: none"
        >
            <label :for="controlId + '-comment'">Comentarios al participante</label>

            <textarea
                :id="controlId + '-comment'"
                :name="controlName + '_comment'"
                class="form-field"
                :class="{
                    'form-field--invalid' : commentErrors.length,
                    'form-field--no-scrollbar' : commentErrors.length
                }"
                rows="4"
                maxlength="255"
                :aria-invalid="commentErrors.length ? 'true' : null"
                :aria-describedBy="commentErrors.length ? controlId + '-comment-errors' : null"
                v-model="$parent.fields[controlName + '_comment']"
                ref="commentTextarea"
            ></textarea>

            <ul v-if="commentErrors.length"
                :id="controlId + '-comment-errors'"
                class="error"
            >
                <li v-for="(error, i) in commentErrors"
                    :key="i"
                    v-text="error"
                ></li>
            </ul>
        </div>
    </div>
</template>

<script>
    import {slide} from '../../../helpers/animation/slide.js';

    export default {
        props: {
            document: {
                type: Object,
                required: true
            },

            formErrors: {
                type: Object,
                required: true
            },

            needsDocumentValidation: {
                type: Boolean,
                required: true
            }
        },

        computed: {
            /**
             * Concatenate the `id` for the control.
             */
            controlId: function() {
                return 'document-' + this.document.id;
            },

            /**
             * Concatenate the `name` for the control.
             */
            controlName: function() {
                return 'document_' + this.document.id;
            },

            /**
             * The list of validation errors for the rejection comment.
             */
            commentErrors: function() {
                const commentErrors = this.formErrors[this.controlName + '_comment'];

                if (! this.formErrors || ! commentErrors) {
                    return [];
                }

                return commentErrors;
            },

            /**
             * The list of validation errors for approval and rejection buttons.
             */
            fieldErrors: function() {
                const fieldErrors = this.formErrors[this.controlName];

                if (! this.formErrors || ! fieldErrors) {
                    return [];
                }

                return fieldErrors;
            }
        },

        methods: {
            /**
             * Emit the updated status and show comment control if needed.
             *
             * @param {number} id
             * @param {string} status
             */
            atStatusChange(id, status) {
                const needsSlide = status === 'rejected' ||
                    (status === 'approved' && this.document.newStatus === 'rejected');

                this.$emit('update-doc-status', id, status);

                if (needsSlide) {
                    slide(
                        this.$refs.commentControl,
                        200,
                        status === 'approved' ? 'up' : 'down'
                    );

                    if (status === 'rejected') {
                        this.$refs.commentTextarea.focus();
                    }
                }
            }
        }
    };
</script>
