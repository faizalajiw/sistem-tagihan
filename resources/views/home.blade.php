@extends('layouts.backend.app')
@section('title', 'Home')
@section('content_title', 'Home')
@section('content')
<x-alert></x-alert>
<div class="row">
	<div class="col-lg">
		<div class="jumbotron">
		@role('admin|petugas')
		  <h1 class="display-4">Hello, {{ Universe::petugas()->nama_petugas }}!</h1>
		@endrole

		@role('dokter')
		  <h1 class="display-4">Hello, {{ Universe::dokter()->nama_dokter }}!</h1>
		@endrole
		  <p class="lead">Selamat datang di E-Tagihan IDI Brebes.</p>
		  <hr class="my-4">
		</div>
	</div>
</div>
@endsection