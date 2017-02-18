@extends('master')
@section('title', 'EyeData - Improve Marketing with our Solutions')

@section('content')

    <div class="container col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>{!! ucfirst($testInfo[0]) !!} <i class="material-icons">description</i> </h2>
                </div>
                    <div class="row" id="data">
                        <div class="col-md-6">
                            <p><strong>Duración: </strong>{!! $testInfo[2] !!} Segundos</p>
                            <p><strong>Fecha: </strong>{!! date('d/m/Y',$testInfo[3]/1000) !!}</p>
                            <p><strong>Tamaño Pantalla: </strong>{!! $testInfo[4] !!} x {!! $testInfo[5] !!}</p>
                        </div>
                        <div class="col-md-6">
                            <div id="image-container"><img src="{!! $testInfo[1] !!}"></div>
                        </div>
                    </div>
            </div>
    </div>

@endsection