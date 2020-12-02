@extends('adminlte2')

@section('content')
@if ($message = Session::get('success'))
	<div class="alert alert-success">
		<p>{{ $message }}</p>
	</div>
@endif
<section class="content-header">
      <h3 style="text-align: center;"><b>
      	<title>Pendataan Obat</title>
        Pendataan Obat Pasien
      </h3></b>
</section>
 
<section class="content">
	<div class="row"> 
		<div class="col-md-12">
			<div class="box">
				<div class="box-body">
					<div class="col-md-12">
					<table style="width: 45%" class="table table-hover table-bordered">
					<tr><th style="text-align: left; ">Nomor RM</th><td> {{$dtpasien->nomorRM}}</td></tr>
					<tr><th style="text-align: left; ">Nama Pasien</th><td> {{$dtpasien->nama}}</td></tr>	
					<tr><th style="text-align: left; ">Umur Pasien</th><td> {{$dtpasien->umur}} Tahun</td></tr>
					<tr><th style="text-align: left; ">Jenis Kelamin</th><td> {{$dtpasien->kelamin}}</td></tr>
					</table>
					<b>Data Obat Tanggal &emsp; </b>{{$cari}} &emsp; <a href="{{url('/cetak/'.$pasien_id.'/'.$cari)}}" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-print"></i> Cetak</a>
          <br><br>
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>No</th>
                <th>Nama Obat</th>
                <th>Dosis</th>
								<th>Jumlah Obat</th>
								<th width="260"></th>
							</tr>
						</thead>
						<tbody>
              <?php 
                $no = 1;
              ?>
							@foreach($tanggal as $tanggal)
							<tr>
                <td>{{ $no++ }}</td>
								<td>{{ $tanggal->nama_obat }}</td>
								<td>{{ $tanggal->dosis }}</td>
								<td>{{ $tanggal->jumlah_obat }}</td>
								<td>
								<button onclick="ubah_obat('{{ $tanggal->id }}','{{ $tanggal->tanggal_pemakaian }}','{{ $tanggal->nama_obat }}','{{ $tanggal->dosis }}','{{ $tanggal->jumlah_obat }}')" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Ubah</button>
								<button onclick="hapus_obat('{{$tanggal->id}}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</button>
                
							</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					
					
					</div>
				</div>
			</div>
			<a href="{{url('/lihat_obat/'.$pasien_id)}}" class="btn btn-default">Kembali</a>
		</div>
	</div>

<!-- Modal Edit Resep -->
  	<div class="modal fade" id="ubah_obat">
  		<div class="modal-dialog" role="document" style="width: 60%">
    		<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title">Ubah Resep</h4>
		      	</div>
      			<div class="modal-body">
    				<form name="form_edit_obat" class="form-horizontal" action="{{url('tanggal_obat/simpan/'.$pasien_id.'/'.$cari)}}" method="post">
              {{csrf_field()}}
              {{method_field('PUT')}}
    					<input type="hidden" class="form-control" name="id" placeholder="No">
              <div class="form-group">
                    <label for="inputanggal" class="col-sm-2 control-label">Tanggal Pemakaian</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" name="tanggal_pemakaian" required="">
                    </div>
                </div>
                <div class="form-group">
          					<label for="inputobat" class="col-sm-2 control-label">Nama Obat</label>
          					<div class="col-sm-10">
            					<input type="input" class="form-control" name="nama_obat" required="">
          					</div>
        				</div>
        				<div class="form-group">
          					<label for="inputdosis" class="col-sm-2 control-label">Dosis</label>
          					<div class="col-sm-10">
            					<input type="input" class="form-control" name="dosis" required="">
          					</div>
        				</div>
        				<div class="form-group">
          					<label for="inputaturan" class="col-sm-2 control-label">Jumlah Obat</label>
          					<div class="col-sm-10">
            					<input type="input" class="form-control" name="jumlah_obat" required="">
          					</div>
        				</div>
        				
        				<div class="modal-footer">
     						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
       						<input type="submit" class="btn btn-warning" value="Ubah">
     					</div>
        				
    				</form>
      			</div>
    		</div>
  		</div>
  </div>
  <!-- /.modal -->



		<div class="modal fade" id="hapus_obat">
  	<div class="modal-dialog">
  		<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Data</h4>
            </div>
        	<div class="modal-body">
            	<p>Hapus Resep&hellip;</p>
        		<form name="form_hapus_obat" class="form-horizontal" action="{{url('tanggal_obat/hapus/'.$pasien_id.'/'.$cari)}}" method="post" enctype="multipart/form-data">
        			<input type="hidden" name="id">
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
	
	function hapus_obat(id){
	document.forms['form_hapus_obat']['id'].value=id;
    $('#hapus_obat').modal('show');
	}
	
    function ubah_obat(id, tanggal_pemakaian, nama_obat, dosis, jumlah_obat){
      document.forms['form_edit_obat']['id'].value=id;
      document.forms['form_edit_obat']['tanggal_pemakaian'].value=tanggal_pemakaian;
      document.forms['form_edit_obat']['nama_obat'].value=nama_obat;
      document.forms['form_edit_obat']['dosis'].value=dosis;
      document.forms['form_edit_obat']['jumlah_obat'].value=jumlah_obat;
      $('#ubah_obat').modal('show');
    }
   
    
</script>

@endsection