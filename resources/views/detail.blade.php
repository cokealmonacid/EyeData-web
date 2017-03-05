@extends('master')
@section('title', 'EyeData - Improve Marketing with our Solutions')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>{!! ucfirst($testInfo[0]) !!}</h2>
                    </div>
                    <div class="row" id="data">
                        <div class="col-md-6">
                            <p><strong>Duración: </strong>{!! $testInfo[2] !!} Segundos</p>
                            <p><strong>Fecha: </strong>{!! date('d/m/Y',$testInfo[3]/1000) !!}</p>
                            <p><strong>Tamaño Pantalla: </strong>{!! $testInfo[4] !!} x {!! $testInfo[5] !!}</p>
                        </div>
                        <div class="col-xs-6"><div id="image-container"><img src="{!! $testInfo[1] !!}"></div></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12" id="button-area">
                <button type="button" class="btn btn-info btn-lg" id="show-button" onclick="changeStatus()">Generar HeatMap</button>
            </div>
        </div>


        <div class="row" id="heatmap-section">
            <div class="col-md-8 col-md-offset-2" id="map">
                <h2>Mapa de calor asociado a Test</h2>
                <div id="heatmap"><img src="{!! $testInfo[1] !!}"></div>
            <script>
                $.ajax({
                    url: "/makeHeatMap/{!! $testInfo[0] !!}",
                    dataType: "json",
                    type: "GET",
                    data: {},
                    success : function(response) {
                        var heatmapInstance = window.h337.create({
                          container: document.getElementById('heatmap'),
                        });

                        var maxVal = 0;

                        for (i = 0; i < response.length;  i++) {
                            var value = response[i].value;
                            if (value > maxVal) {
                                maxVal = value;
                            }
                        }

                        var data = {
                            max: maxVal,
                            data: response
                        };

                        heatmapInstance.setData(data);
                    }
                });
            </script>
            </div>
        </div>

    </div>

@endsection