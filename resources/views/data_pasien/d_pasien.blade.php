@extends('adminltea')

@section('content')
<title>Daftar Pasien</title>
<section class="content-header">
<div class="row">
	<div class="col-md-6" >
		<h3><b>Data Diri Pasien</b></h3>
	</div>
</div>
</section>

<section class="content">
	<div class="row">
    		<div class="col-md-12">
				<div class="box">
					<div class="box-body">
						<table style="width: 45%" class="table table-hover table-bordered">
						<tr><th>Nomor RM</th><td> {{$dtpasien->nomorRM}}</td></tr>
						<tr><th>Nama</th><td> {{$dtpasien->nama}}</td></tr>	
						<tr><th>Umur</th><td> {{$dtpasien->umur}} Tahun</td></tr>
						<tr><th>Alamat</th><td> {{$dtpasien->alamat}}</td></tr>	
						<tr><th>Jenis Kelamin</th><td> {{$dtpasien->kelamin}}</td></tr>	
						</table>
</div> 
</div>
<a href="{{url('/data_pasien')}}" class="btn btn-default">Kembali</a>

</div>
</div>
</section>

 
@endsection