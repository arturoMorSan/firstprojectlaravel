@extends('layout.master')
{{-- Metadata --}}
@section('title', config('app.name'))
@section('description', '""')
@section('canonical', config('app.url'))
@section('content')
<section class="section">
	<div class="container">
		@include('components.alert')
        <h1 class="h2 text-center mb-12">Asistentes en general</h1>
        <p class="text-center my-8">Total de asistentes: <strong>{{ $attendees_count }}</strong></p>
      	
	        <table class="table size-caption table--header-primary mx-auto table--bordered mb-16 md:table--responsive w-full lg:w-4/5">
				<thead>
					<tr><th class="">
							ID
						</th>
						<th class="w-1/5">
							Nombre completo
						</th>
						<th>
							Correo electrónico
						</th>
						<th>
							Universidad o Instituto
						</th>
						<th>
							Cuerpo académico
						</th>
						
					</tr>
				</thead>
				<tbody>
					@foreach($attendees as $attend)
						<tr>
							<td data-label="ID:"> {{ $attend->id }}</td>
							<td data-label="Nombre completo:"> {{ $attend->full_name }}</td>
							<td data-label="Correo electrónico:">{{ $attend->email }}</td>
							<td data-label="Universidad o Instituto:">{{ $attend->university }}</td>
							<td data-label="Cuerpo académico:">{{ $attend->academic_body }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
	</div>
</section>
@endsection
