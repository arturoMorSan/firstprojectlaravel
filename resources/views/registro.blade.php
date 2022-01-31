@extends('layout.master')

{{-- Metadata --}}
@section('title', config('app.name'))
@section('description', '""')
@section('canonical', config('app.url'))
@section('content')
    <section class="section section--bordered" id="registro">
    <div class="container">
        <h1 class="h2 text-center mb-12">
            Registro para la convocatoria <br> {{ $call->title }}
        </h1>

        @if(!$isTime)
            <div class="alert alert--warning d-block m-auto text-center">
                <strong>Muchas gracias por su participación.</strong><br>
                El registro la convocatoria ha concluido.
            </div>
        @else
            <div class="alert alert--info d-block m-auto text-center mb-8">
                <span>Fecha limite para registro el día: {{ $call->fecha_termino }}</span> <br>
            </div>
        @endif



        <attendees-form
            action="{{ url('registro/crear') }}"
            istime="{{ $isTime }}"
            istimespeaker="{{ $isTimeSpeaker }}"
            :documents="{{ $document_required }}"
            call_id="{{ $call->id }}"
            enctype="multipart/form-data"
        >
        </attendees-form>
    </div>
</section>
@endsection