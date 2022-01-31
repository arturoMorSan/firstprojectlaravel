<template>
    <form class="form-boxed bg-white" v-if="istime">
        <div>
            <div class="form-control">
                <label for="project_name">Nombre del proyecto</label>
                <text-field name="project_name" v-model="fields.project_name" maxlength="255" initial=""></text-field>
                <field-errors name="project_name"></field-errors>
            </div>
            <div class="row mb-2">
                <div class="lg:col-1/2 col sm:mb-8">
                    <div class="form-control">
                        <label for="type_assistant">Tipo de asistente</label>
                        <select-field name="type_assistant"  v-model="fields.type_assistant" :options="{'docente' : 'Docente', 'alumno': 'Alumno'}">
                            </select-field>
                        <field-errors name="type_assistant"></field-errors>
                    </div>
                </div>
                <div class="lg:col-1/2 col sm:mb-8">
                    <div class="form-control">
                        <label for="matricula">Matricula: </label>
                        <text-field name="matricula" v-model="fields.matricula" maxlength="15" initial=""></text-field>
                        <field-errors name="matricula"></field-errors>
                    </div>
                </div>
            </div>

            <div class="form-control">
                <label for="full_name">Nombre completo: </label>
                <text-field name="full_name" v-model="fields.full_name" maxlength="60" initial=""></text-field>
                <field-errors name="full_name"></field-errors>
            </div>
            <div class="row mb-4"> 
                <div class="lg:col-1/2 col sm:mb-8">
                    <div class="form-control">
                        <label for="career">Carrera</label>
                        <text-field name="career" v-model="fields.career" maxlength="80" initial=""></text-field>
                        <field-errors name="career"></field-errors>         
                    </div>
                </div>
                <div class="lg:col-1/2 col sm:mb-8">
                    <div class="form-control">
                        <label for="quarter">Cuatrimestre</label>
                        <select-field name="quarter" v-model="fields.quarter" :options="{'1' : '1',
                             '2' : '2',
                             '3' : '3',
                             '4' : '4',
                             '5' : '5',
                             '6' : '6',
                             '7' : '7',
                            '8' : '8',
                            '9' : '9',
                            '10' : '10'}"
                            >
                        </select-field>
                        <field-errors name="quarter"></field-errors>
                    </div>
                </div>                  
            </div>
            <div class="form-control">
                <label for="email">Correo electrónico</label>
                <text-field name="email" v-model="fields.email" maxlength="60" initial=""></text-field>
                <field-errors name="email"></field-errors>
                <ul id="email-specs" class="description color-gray-darken-1">
                    <li>
                        Preferentemente correo institucional
                    </li>
                </ul>              
            </div>
            <div>
                <div v-for="(document, key) in documents" :key="key" class="form-control">
                    <label :for="document.key_name">{{document.name}}</label>
                    <file-field :name="document.key_name" v-model="fields[document.key_name]"></file-field>

                    <field-errors :name="document.key_name"></field-errors>
                    <ul :id="document.key_name+'-specs'" class="description color-gray-darken-1">
                        <li>
                            Tamaño máximo: {{document.max_size}} (Recomendado).
                        </li>
                        <li>
                            Sólo archivos con extensión {{ document.mimes }}
                        </li>
                    </ul>      
                </div>
            </div>
        </div>
        
        <div class="row mb-4">
        
        </div>
        <div class="text-center">
            <form-button class="btn--success btn--wide">
                Registrar
            </form-button>
        </div>
    </form>
</template>
<script>
    import BaseForm from '../base/BaseForm.vue';

   export default {
       extends: BaseForm,
       props: {
            istime: {
                type: String,
                required: false
            },
            istimespeaker: {
                type: String,
                required: false
            },
            documents: {
                type: Array,
                required: true
            },
            call_id: {
                type: String,
                required: true
            }
        },
        data() {
            return {
                fields: {
                    call_id : this.call_id,
                }
            };
        },
        mounted() {
            this.documents.forEach(element => {
                this.fields[element.key_name] = '';
            });
        },
        methods: {
            onChangeSpeaker() {
                this.documents.forEach(element => {
                    this.fields[element.key_name] = '';
                });
                this.fields.category = '';
            }
        }
    };
</script>