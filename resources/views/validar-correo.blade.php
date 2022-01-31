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
					Se validó la cuenta de correo electrónico correctamente.
				</p>
				<p class="text-center mb-12">
					<a class="btn btn--success" href="{{ url('/#programa')}}">Ver programa</a>
				</p>
			</div>
			
		</div>
	</section>
	
@endsection