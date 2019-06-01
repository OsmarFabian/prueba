@extends('layouts.app')
@section('content')

@if (\Session::has('error'))
  <div class="alert alert-danger">
    <p>{{ \Session::get('error') }}</p>
  </div><br />
 @endif

<div class="col-md-6">
	<form action= 'crear_evento'>
		<button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Agregar evento</button>
	</form>

</div>


@endsection