@extends('layouts.app')
@section('content')

@if (\Session::has('error'))
  <div class="alert alert-danger">
    <p>{{ \Session::get('error') }}</p>
  </div><br />
 @endif

 <br>
 <div class="container">
		<table class="table" border="1" id="eventos" border=1>
			<thead>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Tipo</th>
				<th>Precio</th>
				<th>Cliente</th>
				<th>Quién contrató</th>
				<th>Confirmado</th>
			</thead>
			<tbody>
				@foreach ($Eventos as $Evento)
					<tr id="{{$Evento->id}}">
						<td class="fecha" id="{{$Evento->id}}">{{$Evento->fecha}}</td>
						<td class="hora" id="{{$Evento->id}}">{{$Evento->hora}}</td>
						<td class="tipo" id="{{$Evento->id}}">{{$Evento->tipo}}</td>
						<td class="precio" id="{{$Evento->id}}">{{$Evento->precio}}</td>
						<td>
							<a id="{{$Evento->id}}">{{$Evento->cliente_id}}</a>
						</td>
						<td class="quien" id="{{$Evento->id}}">{{$Evento->quien_contrato}}</td>
						<td class="confirmado" id="{{$Evento->id}}">{{$Evento->confirmado}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
</div>

<br>
<!-- Modal -->
<div class="container" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="row" role="document">
	    <div class="modal-content">

			<div class="col-12">
				<h5 class="modal-title" id="exampleModalLabel">Evento</h5>
				<form id="formulario" method="POST" action="/evento">
					<br>
					@csrf
					Fecha: 
					<input type="date" name="fecha" id="fecha">
					<br>
					<br>
					Tipo:
					<select name="tipo" id="tipo" >
						<option>Cumpleaños</option>
						<option>Boda</option>
						<option>XV años</option>
						<option>Reunion Familiar</option>
					</select>
					<br>
					<br>
					Hora:
					<input type="time" name="hora" id="hora">
					<br>
					<br>
					Precio:
					<textarea name="precio" id="precio" placeholder="$" style="height: 26px;"></textarea>
					<br>
					<br>
					<div class="modal-footer">
			        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        	<button type="submit" class="btn btn-success btn-primary" id="btnagregar" >Agregar</button>
					</div>
				</form>
			</div>
	    </div>
	</div>
</div>
@endsection