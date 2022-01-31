@extends('layout.master')

{{-- Metadata --}}
@section('title', config('app.name'))
@section('description', '""')
@section('canonical', config('app.url'))
@section('content')
<section class="section section--bordered section--light" id="registro">
    <div class="container">
        <h1 class="h2 text-center mb-12">Corrección de documentos</h1>
        <p class="text-center mb-12">Uno o varios documentos de la solicitud no han cumplido con los requisitos necesarios. Por favor revisa y los documentos corregido.</p>
        <document-form
            action="{{ url('subir-documentos/'.$attendee->token) }}"
            :documents="{{ $documents }}"
            enctype="multipart/form-data"
        >
        </document-form>
    </div>
</section>
@endsection
