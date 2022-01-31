@extends('layout.master')

{{-- Metadata --}}
@section('title', config('app.name'))
@section('description', '""')
@section('canonical', config('app.url'))
@section('content')
<section class="presentation-container">
    <div class="presentation-overlay">
        <div class="presentation-section container section">
             <div class="lg:row">
                <div class="col">
                    <h2 class="h4 mb-2 presentation-title text-center"><strong>Sistema de Gestión para la Investigación</strong></h2>
                    <h3 class="h5 presentation-title text-center"><strong>"Impulsando a futuros investigadores"</strong></h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section--bordered" id="convocatorias">
    <div class="container">
        <h1 class="h2 text-center mb-12">Convocatorias</h1>
        <div class="row">
            @foreach($calls as $call)
                <div class="card lg:col-1/3 col-1/2">
                    <span class="card-type">
                            {{ $call->type->name }}
                    </span>
                    <div class="card-image">
                        <img src="{{ url('/archivos/convocatorias/'.$call->slug.'/'.$call->cover) }}" class="card-image-one" alt="convocatoria">
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            {{ $call->title }}
                        </div>
                        <p class="card-dates">
                            <em>
                                Periodo del {{ $call->fecha_inicio }} al {{ $call->fecha_termino }}
                            </em>
                        </p>
                        <p class="card-text">
                            {{ $call->description }}
                        </p>
                        <ul class="list-bare list-spaced">
                            <li>
                                <a class="pdf-link" target="_blank" href="{{ url('convocatoria-archivo/'.$call->slug.'/'.$call->document) }}">Ver convocatoria</a>
                            </li>
                            <li>
                                <a class="open-link" href="{{ url('registro/'.$call->slug) }}">Registro</a>
                            </li>

                        </ul>
                    </div>
                </div>
            @endforeach()
        </div>
        <div class="">
            
        </div>
    </div>
</section>
@endsection
