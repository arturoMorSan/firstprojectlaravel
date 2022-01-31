<table>
    <thead>
    <tr>
        <th>Nombre completo</th>
        <th>Matrícula</th>
        <th>Actividad</th>
        <th>Correo electrónico</th>
        <th>Teléfono</th>
        <th>Institución</th>
        <th>Otra institución</th>
        <th>Unidad académica</th>
        <th>Acta de nacimiento</th>
        <th>CURP</th>
        <th>Titulo</th>
        <th>Pago</th>
        <th>¿Pertenece a algún grupo disciplinar de la Incubadora de Cuerpos Académicos?</th>
        <th>¿Cuál?</th>
        <th>¿Pertenece a algún cuerpo académico?</th>
        <th>¿Cuál?</th>
        <th>¿Por qué le interesa este diplomado?</th>
        <th>¿Por qué medio se enteró de este diplomado?</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->full_name }}</td>
            <td>{{ $user->matricula }}</td>
            <td>{{ $user->type_user }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->telephone }}</td>
            <td>{{ $user->school }}</td>
            <td>{{ $user->otra_institution }}</td>
            <td>{{ $user->academic_unit }}</td>
            <td>
                <a href="{{url('/documento/'.str_slug($user->full_name).'/'.$user->acta_nacimiento)}}">
                    Acta de nacimiento
                </a>
            </td>
            <td>
                <a href="{{url('/documento/'.str_slug($user->full_name).'/'.$user->curp)}}">
                    CURP
                </a>
            </td>
            <td>
                <a href="{{url('/documento/'.str_slug($user->full_name).'/'.$user->titulo)}}">
                    titulo
                </a>
            </td>
            <td>
                <a href="{{url('/documento/'.str_slug($user->full_name).'/'.$user->pago)}}">
                    Pago
                </a>
            </td>
            @foreach ($user->question as $question)
                <td>{{ $question->question1 }}</td>
                <td>{{ $question->question1_name }}</td>
                <td>{{ $question->question2 }}</td>
                <td>{{ $question->question2_name }}</td>
                <td>{{ $question->question3 }}</td>
                <td>{{ $question->question4 }}</td>
                
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>