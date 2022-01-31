@extends('layout.master')

{{-- Metadata --}}
@section('title', config('app.name'))
@section('description', '""')
@section('canonical', config('app.url'))
@section('content')
	<section class="section section--light">
		<div class="container">
			<div class="form-boxed bg-white">
				<p class="text-center m-12">
					El enlace para validar tu correo es inválido, posiblemente ya fue usado.
				</p>
				<p class="text-center mb-12">
					<a class="btn btn--success" href="{{ url('/')}}">Regresar a página de inicio</a>
				</p>
			</div>
			
		</div>
	</section>
	
@endsection
