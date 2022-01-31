<template>
    <base-modal name="cancel-procedure"
        v-slot="{params}"
    >
        <h2 class="base-modal__title mb-10">
            Rechazar solicitud
        </h2>

        <p class="alert alert--warning alert--has-icon mb-6">
            Una vez cancelado el ponente, no se puede volver a aceptar.
        </p>

        <base-form :action="`${$root.path}/admin/ponente/${procedureId}/cancelar`"
            :initial="{cancel_comment: params.comment}"
            inline-template
        >
            <form>
                <div class="form-control">
                    <label for="cancel-comment">Escribe el mensaje que se enviará por correo electrónico al solicitante.</label>

                    <text-area
                        v-model="fields.cancel_comment"
                        name="cancel_comment"
                        rows="6"
                        maxlength="255"
                        aria-describedby="cancel-comment-count"
                    ></text-area>

                    <p id="cancel-comment-count" class="description mt-0">
                        {{ fields.cancel_comment ? fields.cancel_comment.length : 0 }}/255 caracteres.
                    </p>

                    <field-errors name="cancel_comment"></field-errors>
                </div>

                <div class="text-center mt-10">
                    <button class="btn btn--light mr-3 px-8 max-w-150 sm:w-1/2"
                        type="button"
                        @click="$root.$emit('ModalCancelComment', fields.cancel_comment) && $root.$emit('closeModal')"
                    >
                        Cancelar
                    </button>

                    <form-button class="btn--db px-8 max-w-150 sm:w-1/2">Enviar</form-button>
                </div>
            </form>
        </base-form>
    </base-modal>
</template>

<script>
    export default {
        props: {
            procedureId: {
                required: true,
                type: [Number, String]
            }
        }
    };
</script>
