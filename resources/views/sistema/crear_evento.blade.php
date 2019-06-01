@extends('layouts.app')
@section('content')

@if (\Session::has('error'))
  <div class="alert alert-danger">
    <p>{{ \Session::get('error') }}</p>
  </div><br />
 @endif

 <br>
 <table id="eventos" border=1>
	<thead>
		<th>Fecha</th>
		<th>Tipo</th>
		<th>Cliente</th>
		<th></th>
	</thead>
	<tbody>
@foreach ($Eventos as $Evento)
	<tr id="{{$Evento->id}}">
		<td class="fecha" id="{{$Evento->id}}">{{$Evento->fecha}}</td>
		<td class="tipo" id="{{$Evento->id}}">{{$Evento->tipo}}</td>
		<td class="cliente_id" id="{{$Evento->id}}">{{$Evento->quien->nombre}}</td>
		<td>
			<a id="{{$Evento->id}}">x</a>
		</td>
	</tr>
@endforeach
	</tbody>
</table>



<br>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<form id="formulario" method="POST" action="/destino3">
				@csrf
				Fecha:<input type="date" name="fecha" id="fecha"><br>
				Tipo:
<select name="tipo" id="tipo" >
	<option>Cumpleaños</option>
	<option>Boda</option>
	<option>XV años</option>
	<option>Reunion Familiar</option>
</select>
<br>
</select>
			</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btnagregar" >Agregar</button>
      </div>
    </div>
  </div>
</div>

 @endsection