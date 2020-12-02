@extends('adminlte')

@section('content')

@if ($message = Session::get('success'))
	<div class="alert alert-success">
		<p>{{ $message }}</p>
	</div>
@endif
@if ($message = Session::get('danger'))
	<div class="alert alert-danger">
		<p>{{ $message }}</p>
	</div>
@endif 
<title>Cari Pasien</title>
<head>
	<style>
		#wrapper {
		     margin: 200px auto;
		}
</style>
</head>

<section class="content-header">
<div class="row">
	<div class="col-lg-4"></div>
	<div class="col-lg-4">
		<form action="/search" method="post">
			{{csrf_field()}}
			<div class="input-group" id="wrapper">
				<input type="search" name="search" placeholder="Masukan Nomor RM" class="form-control">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
				</span>
			</div>
		</form> 
	</div>
	
</div>
</section>
@endsection

