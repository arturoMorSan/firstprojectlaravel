<section class="section" id="programa">
	<div class="container">
		@include('components.alert')
        <h1 class="h2 text-center mb-12">Programa</h1>

        <table class="table size-caption table--header-primary mx-auto table--bordered mb-16 md:table--responsive w-full lg:w-4/5">
            <thead>
                <tr>
                    <th class="w-1/6">
                        
                    </th>
                    <th>
                        Aula 1
                    </th>
                    <th>
                        Aula 2
                    </th>
                    <th>
                        Aula 3
                    </th>
                    <th>
                        Aula 4
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="align-middle program__align-text md:bg-gray-lighten-4"
                        data-label="Hora:">
                        9:00 - 10:10
                    </td>
                    <td data-label="Aula 1: ">
                        <div>
                                <p class="mt-1 mb-1 program__align-text">
                                <b class="mt-2">Inauguración y ponencia</b> <br>
                            </p>
                            <p class="size-sm color-gray-darken-2 mb-0">
                                <b>Ponencia:</b> ¿Hay razones para hacer investigación?<br>
                                <b>Ponente:</b> Dr. Jorge Alberto Alvarez Díaz<br>

                            </p>
                            <div class="size-sm color-gray-darken-2 mb-2" style="margin-left: 53px;">
                                Profesor Investigador Universidad Autónoma Metropolitana Unidad Xochimilco
                            </div>
                            {{-- <p class="size-sm color-gray-darken-2">
                                <a
                                    target="_blank"
                                    href="">
                                    Enlace a la reunión
                                </a> <br>
                                Número de reunión: <br>
                                Contraseña:  <br>
                                Clave de organizador:
                            </p> --}}
                        </div>
                    </td>
                    <td data-label="Aula 2:">
                        
                    </td>
                    <td data-label="Aula 3:">
                        
                    </td>
                    <td data-label="Aula 4:">
                        
                    </td>
                </tr>
                <tr>
                    <td class="align-middle program__align-text md:bg-gray-lighten-4"
                        data-label="Hora:">
                        10:10 - 11:30 <br> 11:50 - 13:30
                    </td>
                    <td data-label="Aula 1:">
                        <div>
                            <p class="program__align-text mt-1 mb-8">
                                <a href="{{ url('archivos/PROGRAMA_FINAL_PRESENTACIONES-aula1.pdf') }}">Programa de Presentaciones Orales</a>
                            </p>
                            <p class="size-sm text-center color-gray-darken-2 mb-0">
                                <a href="https://edistanciaujed.webex.com/edistanciaujed-sp/j.php?MTID=mb84658fde762ef2b82fd2c053b47162b">
                                    enlace webex
                                </a>
                            </p>
                            </div>

                    </td>
                    <td data-label="Aula 2:">
                        <div>
                            <p class="program__align-text mt-1 mb-8">
                                <a href="{{ url('archivos/PROGRAMA_FINAL_PRESENTACIONES-aula2.pdf') }}">Programa de Presentaciones Orales</a>
                            </p>
                            <p class="size-sm text-center color-gray-darken-2 mb-0">
                                <a href="https://edistanciaujed.webex.com/edistanciaujed-sp/j.php?MTID=m8d5074f9ce025cd8be3c0c4a61c24647">
                                    enlace webex
                                </a>
                            </p>
                            </div>

                    </td>
                    <td data-label="Aula 3:">
                        <div>
                            <p class="program__align-text mt-1 mb-8">
                                <a href="{{ url('archivos/PROGRAMA_FINAL_PRESENTACIONES-aula3.pdf') }}">Programa de Presentaciones Orales</a>
                            </p>
                            <p class="size-sm text-center color-gray-darken-2 mb-0">
                                <a href="https://edistanciaujed.webex.com/edistanciaujed-sp/j.php?MTID=mfb26c9000418a85c1ffacc759d141d14">
                                    enlace webex
                                </a>
                            </p>
                        </div>
                    </td>
                    <td data-label="Aula 4:">
                        <div>
                            <p class="program__align-text mt-1 mb-8">
                                <a href="{{ url('archivos/PROGRAMA_FINAL_PRESENTACIONES-aula4.pdf') }}">Programa de Presentaciones Orales</a>
                            </p>
                            <p class="size-sm text-center color-gray-darken-2 mb-0">
                                <a href="https://edistanciaujed.webex.com/edistanciaujed-es/j.php?MTID=m1bd4055e097c6bd9bada011ca2c96dbf">
                                    enlace webex
                                </a>
                            </p>
                        </div>
                    </td>

                    
                </tr>
                <tr>
                    <td class="align-middle program__align-text md:bg-gray-lighten-4"
                        data-label="Hora:">
                        11:30 - 11:50
                    </td>
    
                    <td colspan="4" data-label="Aulas:">
                        <p class="program__align-text mt-1 mb-2">
                            <b class="mt-2">Receso</b>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="align-middle program__align-text md:bg-gray-lighten-4"
                        data-label="Hora:">
                        13:50 - 14:00
                    </td>
                    <td  data-label="Aula 1:">
                        <p class="program__align-text mt-1 mb-2">
                            <b class="mt-2">Reconocimientos y clausura</b>
                        </p>
                    </td>
                    <td  data-label="Aula 2:">
                       
                    </td>
                    <td  data-label="Aula 3:">
                        
                    </td>
                    <td  data-label="Aula 4:">
                        
                    </td>
                    
                    
                </tr>
            </tbody>
        </table>
        <div class="row">
        	<div class="alert alert--info d-block m-auto">
        		<strong>Nota: </strong>Es indispensable que se registren para poder obtener su constancia de asistencia al evento.
        	</div>
        </div>
	</div>
</section>
