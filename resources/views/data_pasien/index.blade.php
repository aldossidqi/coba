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
@if($errors->has('nomorRM'))
<div class="alert alert-danger" role="alert"> {{$errors->first('nomorRM')}} </div>
@endif
@if($errors->has('nama'))
<div class="alert alert-danger" role="alert"> {{$errors->first('nama')}} </div>
@endif
@if($errors->has('umur'))
<div class="alert alert-danger" role="alert"> {{$errors->first('umur')}} </div>
@endif
@if($errors->has('alamat'))
<div class="alert alert-danger" role="alert"> {{$errors->first('alamat')}} </div>
@endif
<title>Daftar Pasien</title>
<section class="content-header">
<div class="row"> 
	<div class="col-md-6">
		<h3><b>Daftar Pasien</b></h3>
	</div>
	<div class="col-md-4">
		<form action="/searchnama" method="post">
			{{csrf_field()}}
			<div class="input-group">
				<input type="search" name="search" placeholder="Masukan Nama Pasien" class="form-control">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
				</span>
			</div>
		</form> 
	</div>
	<div class="col-md-2 text-right">
		<button onclick="tambah_pasien()" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Pasien</button>
	</div>
</div>
</section>

<section class="content">
	<div class="row">
    		<div class="col-md-12">
				<div class="box">
					<div class="box-body">
<table id="example1" class="table table-bordered table-hover" >
	<thead>
		<tr>
			<th>Nomor RM</th>
			<th>Nama</th>
			<th>Umur</th>
			<th>Jenis Kelamin</th>
			<th>Alamat</th>
			<th width="260"></th>
		</tr>
	</thead>
	<tbody>
		@foreach($pasien as $dtpasien)
		<tr>
			<td>{{ $dtpasien->nomorRM }}</td>
			<td>{{ $dtpasien->nama }}</td>
			<td>{{ $dtpasien->umur }}</td>
			<td>{{ $dtpasien->kelamin }}</td> 
			<td>{{ $dtpasien->alamat }}</td>
			
			<td>
			<a href="{{url('/tampil_pasien/'.$dtpasien->nomorRM)}}"  class="btn btn-info"><i class="fa fa-eye"></i> Lihat</a>
			<button onclick="ubah_pasien('{{ $dtpasien->nomorRM }}','{{ $dtpasien->nama }}','{{ $dtpasien->umur }}','{{ $dtpasien->kelamin }}','{{ $dtpasien->alamat }}')" class="btn btn-warning"><i class="fa fa-edit"></i> Ubah</button>
			<button onclick="hapus_pasien('{{$dtpasien->nomorRM}}')" class="btn btn-danger"><i class="fa fa-trash-o"></i> Hapus</button>
		</td>
		</tr>
		@endforeach
	</tbody>
</table>
{{$pasien->links()}}
</div>
</div>
</div>


	<!-- Modal Edit pasien -->
  	<div class="modal fade" id="tambah_pasien">
  		<div class="modal-dialog" role="document" style="width: 60%">
    		<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title">Tambah Data Pasien</h4>
		      	</div>
      			<div class="modal-body">
    				<form name="form_tambah_pasien" class="form-horizontal" action="{{url('/simpant_pasien')}}" method="post">
    			</div>
                <div class="form-group">
  					<label for="inputnomorRM" class="col-sm-2 control-label">Nomor RM</label>
                    <div class="col-sm-10">
                      <input type="input" class="form-control" name="nomorRM" required="">
                    </div>
				</div><br><br>
                <div class="form-group">
  					<label for="inputnama" class="col-sm-2 control-label">Nama</label>
  					<div class="col-sm-10">
    					<input type="input" class="form-control" name="nama" required="">
  					</div>
				</div><br><br>
				<div class="form-group">
  					<label for="inputnama" class="col-sm-2 control-label">Umur</label>
  					<div class="col-sm-10">
    					<input type="number" class="form-control" name="umur" required="">
  					</div>
				</div><br><br>
				<div class="form-group">
  					<label for="inputnama" class="col-sm-2 control-label">Alamat</label>
  					<div class="col-sm-10">
    					<input type="input" class="form-control" name="alamat" required="">
  					</div>
				</div><br><br>
				<div class="form-group">
  					<label for="inputnama" class="col-sm-2 control-label">Jenis Kelamin</label>
  					<div class="col-sm-10">
    					<select name="kelamin" class="form-control">
							<option value="Laki-laki">Laki-laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
  					</div>
				</div><br><br>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-warning" value="Simpan">
				</div>
        				{{csrf_field()}}
        			</form>
      			</div>
    		</div>
  		</div>
  </div>
  <!-- /.modal -->

  <!-- Modal Edit pasien -->
  	<div class="modal fade" id="ubah_pasien">
  		<div class="modal-dialog" role="document" style="width: 60%">
    		<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title">Ubah Data Pasien</h4>
		      	</div>
      			<div class="modal-body">
    				<form name="form_edit" class="form-horizontal" action="{{url('/simpanu_pasien')}}" method="post">
    			</div>
                <div class="form-group">
  					<label for="inputnomorRM" class="col-sm-2 control-label">Nomor RM</label>
                    <div class="col-sm-10">
                      <input type="input" class="form-control" name="nomorRM" required="">
                      @if($errors->has('nomorRM'))
                    <div class="alert alert-danger" role="alert"> {{$errors->first('nomorRM')}} </div>
                    @endif
                    </div>
				</div><br><br>
                <div class="form-group">
  					<label for="inputnama" class="col-sm-2 control-label">Nama</label>
  					<div class="col-sm-10">
    					<input type="input" class="form-control" name="nama" required="">
  					</div>
				</div><br><br>
				<div class="form-group">
  					<label for="inputnama" class="col-sm-2 control-label">Umur</label>
  					<div class="col-sm-10">
    					<input type="number" class="form-control" name="umur" required="">
  					</div>
				</div><br><br>
				<div class="form-group">
  					<label for="inputnama" class="col-sm-2 control-label">Alamat</label>
  					<div class="col-sm-10">
    					<input type="input" class="form-control" name="alamat" required="">
  					</div>
				</div><br><br>
				<div class="form-group">
  					<label for="inputnama" class="col-sm-2 control-label">Jenis Kelamin</label>
  					<div class="col-sm-10">
    					<select name="kelamin" class="form-control">
							<option value="Laki-laki">Laki-laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
  					</div>
				</div><br><br>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-warning" value="Simpan">
				</div>
        				{{csrf_field()}}
        				{{method_field('PUT')}}
        			</form>
      			</div>
    		</div>
  		</div>
  
  <!-- /.modal -->

  <div class="modal fade" id="hapus_pasien">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Data</h4>
            </div>
          <div class="modal-body">
              <p>Hapus Data Pasien&hellip;</p>
            <form name="form_hapus" class="form-horizontal" action="{{url('/hapus_pasien')}}" method="post" enctype="multipart/form-data">
              <input type="hidden" name="nomorRM">
              <div class="modal-footer">
                    <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-danger" value="Hapus">
              </div>
              {{csrf_field()}}
              {{method_field('DELETE')}}
            </form>
          </div>
          </div>
    <!-- /.modal-content -->
    </div>
   <!-- /.modal-dialog -->
   </div>


</section>

<script>
function tambah_pasien(){
      
      $('#tambah_pasien').modal('show');
    }
function ubah_pasien(nomorRM, nama,  umur, kelamin, alamat){
      document.forms['form_edit']['nomorRM'].value=nomorRM;
      document.forms['form_edit']['nama'].value=nama;
      document.forms['form_edit']['umur'].value=umur;
      document.forms['form_edit']['kelamin'].value=kelamin;
      document.forms['form_edit']['alamat'].value=alamat;
      
      $('#ubah_pasien').modal('show');
    }
 function hapus_pasien(nomorRM){
  document.forms['form_hapus']['nomorRM'].value=nomorRM;
    $('#hapus_pasien').modal('show');
  }
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endsection

