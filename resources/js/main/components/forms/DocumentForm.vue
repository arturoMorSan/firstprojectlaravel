<template>
    <form class="form-boxed bg-white">
        <div v-for="(document, key) in documents" :key="key">
            <p class="alert alert--info">
                <b>{{ document.document_type.name }}</b></br>
                {{ document.comment }}
            </p>
            <div class="form-control mb-12">
                <label :for="document.document_type.key_name">{{ document.document_type.name }}</label>
                <file-field :name="document.document_type.key_name" v-model="fields[document.document_type.key_name]"></file-field>

                <field-errors :name="document.document_type.key_name"></field-errors>
                <ul :id="document.document_type.key_name+'-specs'" class="description color-gray-darken-1">
                    <li>
                        Tamaño máximo: {{document.document_type.max_size}}.
                    </li>
                    <li>
                        Sólo archivos con extensión {{ document.document_type.mimes }}
                    </li>
                </ul>
            </div>
        </div>
        <div class="text-center">
            <form-button class="btn--success btn--wide">
                Subir
            </form-button>
        </div>
    </form>
</template>
<script>
   import BaseForm from './base/BaseForm.vue';
   export default {
       extends: BaseForm,
       props: {
            documents: {
                type: Array,
                required: true
            }
        },
        mounted() {
            this.documents.forEach(element => {
                this.fields[element.document_type.key_name] = '';
            });
        },
    };
</script>