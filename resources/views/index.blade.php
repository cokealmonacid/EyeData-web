@extends('master')
@section('title', 'EyeData - Improve Marketing with our Solutions')

@section('content')

    <div class="container col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2> Test disponibles <i class="material-icons">rate_review</i> </h2>
                </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Duración</th>
                                <th>Datos</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($response as $data)
                        	<tr>
                        		<td>{!! ucfirst($data[0]) !!}</td>
                        		<td>{!! date('d/m/Y',$data[3]/1000) !!}</td>
                        		<td>{!! $data[2] !!} Seg</td>
                        		<td><a href="#">Ver más</a></td>
                        	</tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
    </div>

@endsection
