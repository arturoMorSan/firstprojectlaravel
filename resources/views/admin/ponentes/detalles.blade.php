@extends('layout.dashboard-master')

{{-- Metadata --}}
@section('meta.title', 'Detalle de ponente' )
@section('meta.tab_title', 'Detalle de ponente | Panel de administración | ' . config('app.name'))
@section('css_classes', 'dashboard')
@section('content')
 <section class="section">
        <div class="container container--admin">

            <procedure-detail
                :attendee="{{ $attendee }}"
                :documents="{{ $attendee->documents }}"
            >
                <template slot="check">
                    @svg('check','svg-w-6 mr-2')
                </template>
                <template slot="x">
                    @svg('x', 'svg-w-6 mr-2')
                </template>
            </procedure-detail>
        </div>
    </section>

@endsection
