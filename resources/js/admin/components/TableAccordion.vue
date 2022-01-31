<template>
    <table class="table table-resource table--striped"
    >
        <thead>
            <tr class="table-resource__headings">
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Teléfono</th>
                <th>Acta nacimiento</th>
                <th>Curp</th>
                <th>Titulo</th>
                <th>Pago</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <template v-for="userItem in users">
                <tr>
                    <td>
                        {{ userItem.users.name }} {{ userItem.users.last_name }}
                    </td>
                    <td>
                        {{ userItem.users.email }}
                    </td>
                    <td>
                        {{ userItem.users.telephone }}
                    </td>
                    <td>
                        <a :href="$root.path + '/documento/'+userItem.users.name+userItem.users.last_name+'/'+userItem.users.acta_nacimiento">
                            <img style="width:25px;" :src="$root.path +'/img/icons/icon-pdf.png'">
                        </a>
                    </td>
                    <td>
                        <a :href="$root.path + '/documento/'+userItem.users.name+userItem.users.last_name+'/'+userItem.users.curp">
                            <img style="width:25px;" :src="$root.path +'/img/icons/icon-pdf.png'">
                        </a>
                    </td>
                    <td>
                        <a :href="$root.path + '/documento/'+userItem.users.name+userItem.users.last_name+'/'+userItem.users.titulo">
                            <img style="width:25px;" :src="$root.path +'/img/icons/icon-pdf.png'">
                        </a>
                    </td>
                    <td>
                        <a :href="$root.path + '/documento/'+userItem.users.name+userItem.users.last_name+'/'+userItem.users.pago">
                            <img style="width:25px;" :src="$root.path +'/img/icons/icon-pdf.png'">
                        </a>
                    </td>
                    <td>
                        <button class="btn--xs btn--success" :data-id="userItem.id"
                            @click.prevent="openDiv">
                            Expandir
                        </button>
                    </td>
                </tr>
                <tr :ref="userItem.id" class="table-accordion-container hidden">
                    <td colspan="8">
                        <div class="row">
                            <div class="table-files-container col">
                                <p class="h5"><strong>Preguntas</strong></p>
                                <dl v-for="question in userItem.users.question">
                                    <dt>
                                        ¿Pertenece a algún grupo disciplinar de la Incubadora de Cuerpos Académicos?
                                    </dt>
                                    <dd>
                                        <span v-if="question.question1 == 'si'">{{ question.question1 }}, {{ question.question1_name }}</span>
                                        <span v-else> {{ question.question1 }} </span>
                                    </dd>
                                    <dt>
                                        ¿Pertenece a algún cuerpo académico?
                                    </dt>
                                    <dd>
                                        <span v-if="question.question2 == 'si'">{{ question.question2 }}, {{ question.question2_name }}</span>
                                        <span v-else> {{ question.question2 }} </span>
                                    </dd>
                                    <dt>
                                        ¿Por qué le interesa este diplomado?
                                    </dt>
                                    <dd>
                                        <span> {{ question.question3 }} </span>
                                    </dd>
                                    <dt>
                                        ¿Por qué medio se enteró de este diplomado?
                                    </dt>
                                    <dd>
                                        <span> {{ question.question4 }} </span>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </td>
                </tr>
            </template>

        </tbody>
    </table>
</template>
<script>
    import merge from 'deepmerge';

    export default {
        props: {
            users: {
                type: Array,
                required: true
            },
        },
        methods: {

            openDiv(e) {
                const id = e.currentTarget.getAttribute('data-id');
                if (this.$refs[id][0].classList.contains('hidden')) {
                    this.$refs[id][0].classList.remove('hidden');
                } else {
                    this.$refs[id][0].classList.add('hidden');
                }
            }
        }
    }
</script>