<template>
    <form>
        <section class="db-panel">
            <h3 class="db-panel__title">
                Datos de convocatoria
            </h3>

            <div class="md:row">
                <div class="md:col-2/3">
                    <div class="form-control">
                        <label for="title">Titulo</label>
                        <text-field name="title" v-model="fields.title" :initial="call.title || ''">
                        </text-field>
                        <field-errors name="title"></field-errors>
                    </div>

                    <div class="form-control">
                        <label for="type">Tipo de convocatoria</label>
                        <select-field name="type"
                            v-model="fields.type"
                            :options="call_types"
                            :initial="call.call_type_id || null"
                        >
                        </select-field>
                        <field-errors name="type"></field-errors>
                    </div>

                    <div class="form-control">
                        <label for="description">Descripción</label>
                        <text-field name="description" v-model="fields.description" :initial="call.description || ''">
                        </text-field>
                        <field-errors name="description"></field-errors>
                    </div>
                    <div v-if="Object.keys(call).length != 0" class="md:row">
                        <div class="md:col-3/4">
                            <div class="form-control">
                                <label for="document">Documento</label>
                                <file-field name="document" v-model="fields.document" aria-describedby="document-specs"></file-field>
                                <field-errors name="document"></field-errors>
                                <ul id="document-specs" class="description color-gray-darken-1">
                                    <li>Tamaño máximo: 5 MB.</li>
                                    <li>Sólo archivos con extensión pdf.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="md:col-1/4">
                            Documento adjunto <br>
                            <a :href="$root.path+'/archivos/convocatorias/'+call.slug+'/'+call.document"> {{ call.title }} </a>

                        </div>
                    </div>
                    <div v-else>
                        <div class="form-control">
                            <label for="document">Documento</label>
                            <file-field name="document" v-model="fields.document" aria-describedby="document-specs"></file-field>
                            <field-errors name="document"></field-errors>
                            <ul id="document-specs" class="description color-gray-darken-1">
                                <li>Tamaño máximo: 5 MB.</li>
                                <li>Sólo archivos con extensión pdf.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:row mb-12">
                        <div class="md:col-1/2">
                            <div class="form-control">
                                <label for="liberation-date">Fecha de inicio</label>

                                <date-field name="start_date"
                                    v-model="fields.start_date"
                                    :initial="call.start_date || ''"
                                    :aria-describedby="supportsDates ? '' : 'start-date-description'"
                                ></date-field>

                                <field-errors name="start_date"></field-errors>

                                <p v-if="! supportsDates" id="start-date-description" class="description">
                                    Formato: dd/mm/aaaa
                                </p>
                            </div>
                        </div>
                        <div class="md:col-1/2">
                            <div class="form-control">
                                <label for="liberation-date">Fecha de termino</label>

                                <date-field name="finish_date"
                                    v-model="fields.finish_date"
                                    :initial="call.finish_date || ''"
                                    :aria-describedby="supportsDates ? '' : 'finish-date-description'"
                                ></date-field>

                                <field-errors name="finish_date"></field-errors>

                                <p v-if="! supportsDates" id="finish-date-description" class="description">
                                    Formato: dd/mm/aaaa
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="db-panel">
            <h3 class="db-panel__title">
                Portada
            </h3>
            <div class="md:row">
                <div class="md:col-2/3">
                    <div class="form-control">
                        <label for="cover">Documento</label>
                        <file-field name="cover" v-model="fields.cover" aria-describedby="cover-specs"></file-field>
                        <field-errors name="cover"></field-errors>
                        <ul id="cover-specs" class="description color-gray-darken-1">
                            <li>Tamaño máximo: 5 MB.</li>
                            <li>Sólo archivos con extensión jpg, .png.</li>
                        </ul>
                    </div>
                </div>
                <div class="md:col-1/3">
                    <div v-if="call.cover">
                        <figcaption class="preview-box__caption">
                            Portada actual
                        </figcaption>
                        <figure class="preview-aside__box preview-box">
                            <img :src="$root.path+'/archivos/convocatorias/'+call.slug+'/'+call.cover" alt="">
                        </figure>
                    </div>
                    <div v-else>
                        <figcaption class="preview-box__caption">
                            Sin portada
                        </figcaption>
                    </div>

                </div>
            </div>
        </section>
        <div class="text-center pt-8">
            <form-button class="btn--primary btn--wide">
                Enviar
            </form-button>
        </div>
   </form>
</template>

<script>
    import BaseForm from '../../../../main/components/forms/base/BaseForm';
    import CallPeriodForm from './CallPeriodForm.vue';
    import CallFileForm from './CallFileForm.vue';
    import ProfileGalleryCard from '../../../../main/components/ProfileGalleryCard.vue';
    export default {
        extends: BaseForm,

        components: { CallPeriodForm, CallFileForm, ProfileGalleryCard},
        props: {

            call_types: {
                required: true,
                type: Object
            },
            call: {
                required:false,
                type: Object
            },
        },
        data() {
            return {
                firstTime: null,
                files_types: this.file_types,
            };
        },

        watch: {

            firstTime: function(val) {
                this.fields._method = val === false ? 'patch' : 'post';
            }
        },
    };
</script>
