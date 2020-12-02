@extends('adminlte2')

@section('content')

@if ($message = Session::get('success'))
	<div class="alert alert-success">
		<p>{{ $message }}</p>
	</div>
@endif
@if($errors->has('nama_obat'))
<div class="alert alert-danger" role="alert"> {{$errors->first('nama_obat')}} </div>
@endif
@if($errors->has('dosis'))
<div class="alert alert-danger" role="alert"> {{$errors->first('dosis')}} </div>
@endif
@if($errors->has('jumlah_obat'))
<div class="alert alert-danger" role="alert"> {{$errors->first('jumlah_obat')}} </div>
@endif
@if($errors->has('tanggal_pemakaian'))
<div class="alert alert-danger" role="alert"> {{$errors->first('tanggal_pemakaian')}} </div>
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
                <tr><th>Nomor RM</th><td> {{$dtpasien->nomorRM}}</td></tr>
                <tr><th>Nama Pasien</th><td> {{$dtpasien->nama}}</td></tr>  
                <tr><th>Umur Pasien</th><td> {{$dtpasien->umur}} Tahun</td></tr>
                <tr><th>Jenis Kelamin</th><td> {{$dtpasien->kelamin}}</td></tr>
                </table>
                </div>
                
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link" href="#resep" role="tab" data-toggle="tab">Tambah Obat</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#cari" role="tab" data-toggle="tab">Cari Berdasarkan Tanggal</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="#riwayat" role="tab" data-toggle="tab">Obat Pasien</a>
                  </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                  
                  <div role="tabpanel" class="tab-pane fade" id="resep">
                    <div class="col-md-12">
                      <form action="{{url('lihat_obat/input')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="pasien_id" value="{{$pasien_id}}">
                        <div class="form-group">
                          <label>Nama Obat</label>
                          <input class="form-control" type="text" list="namaobat" name="nama_obat" placeholder="Nama Obat" required="">
                          <datalist id="namaobat">
                            <option>Furosemid tab 40 mg</option>
                            <option>Ramipril tab</option>
                            <option>Tanapres tab</option>
                            <option>Candersartan tab</option>
                            <option>Valsartan tab</option>
                            <option>Spironolacton tab 25 mg</option>
                            <option>Aspilet tab 80 mg</option>
                            <option>Cloropidogrel tab 75 mg</option>
                            <option>Brilinta tab 90 mg</option>
                            <option>Simvastatin tab 20 mg</option>
                            <option>Isdn tab 5 mg</option>
                            <option>Nitrokaf tab 1 mg</option>
                            <option>Concor tab 2.5 mg</option>
                            <option>Bisoprolol tab 5 mg</option>
                          </datalist>
                        </div>
                        <div class="form-group">
                          <label>Dosis</label>
                          <input class="form-control" type="text" name="dosis" placeholder="Dosis" required="">
                        </div>
                        <div class="form-group">
                          <label>Jumlah Obat</label>
                          <input class="form-control" type="text" name="jumlah_obat" placeholder="Jumlah Obat" required="">
                        </div>
                        
                        <button class="btn btn-primary" type="submit">Simpan</button></form>
                    </div>
                  </div>

                  <div role="tabpanel" class="tab-pane fade" id="cari">
                    <div class="col-md-12"><br>
                      <form action="{{url('cari_obat/'.$pasien_id)}}" method="post">
                        {{csrf_field()}}
                        <div class="input-group">
                          <select name="tanggal" class="form-control">
                            @foreach($ft as $t)
                            <option>{{$t}}</option>
                            @endforeach
                          </select>
                        <span class="input-group-btn">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </span>
                        </div>
                      </form>
                      
                    </div>
                  </div>

                  <div role="tabpanel" class="tab-pane fade in active" id="riwayat">
                    <div class="col-md-12">
    								<br>
    							<b>Data Obat Pasien</b> 
                  <br><br>
    								<table class="table table-hover table-bordered">
    								<thead>
    									<tr>
    										<th>No</th>
                        <th>Nama Obat</th>
                        <th>Tanggal Pemakaian</th>
    										<th>Dosis</th>
    										<th>Jumlah Obat</th>

    										<th></th>
    									</tr>
    								</thead>
    								<tbody>
    									<?php 
    										$no = 1;
    									?>
    									@foreach($resep as $resep)
    									<tr>
    										<td>{{ $no++ }}</td>
                        <td>{{ $resep->nama_obat }}</td>
                        <td>{{ $resep->tanggal_pemakaian}}</td>
    										<td>{{ $resep->dosis }}</td>
    										<td>{{ $resep->jumlah_obat }}</td>
    										<td>
    											<button onclick="ubah_resep('{{ $resep->id }}','{{ $resep->tanggal_pemakaian }}','{{ $resep->nama_obat }}','{{ $resep->dosis }}','{{ $resep->jumlah_obat }}')" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i> Ubah</button>
    		            							<button onclick="hapus_resep('{{$resep->id}}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</button>
    										</td>
    									</tr>
    									@endforeach
    								</tbody>
    								</table>
      							</div>
                  </div>
                  </div>

                  
						
					</div>
				</div>
			</div>
		</div>
		
  		<!-- Modal Edit Resep -->
  	<div class="modal fade" id="ubah_resep">
  		<div class="modal-dialog" role="document" style="width: 60%">
    		<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          	<span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title">Ubah Resep</h4>
		      	</div>
      			<div class="modal-body">
    				<form name="form_edit_resep" class="form-horizontal" action="{{url('lihat_obat/simpan')}}" method="post">
    					<input type="hidden" class="form-control" name="id" placeholder="No">
              <div class="form-group">
                    <label for="inputtgln" class="col-sm-2 control-label">Tanggal Pemakaian</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" name="tanggal_pemakaian" required="">
                    </div>
                </div>
                <div class="form-group">
          					<label for="inputnmobt" class="col-sm-2 control-label">Nama Obat</label>
          					<div class="col-sm-10">
            					<input type="input" class="form-control" name="nama_obat" required="">
          					</div>
        				</div>
        				<div class="form-group">
          					<label for="inputjmlobt" class="col-sm-2 control-label">Dosis</label>
          					<div class="col-sm-10">
            					<input type="input" class="form-control" name="dosis" required="">
          					</div>
        				</div>
        				<div class="form-group">
          					<label for="inputatrnpk" class="col-sm-2 control-label">Jumlah Obat</label>
          					<div class="col-sm-10">
            					<input type="input" class="form-control" name="jumlah_obat" required="">
          					</div>
        				</div>
        				
        				<div class="modal-footer">
     						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
       						<input type="submit" class="btn btn-warning" value="Ubah">
     					</div>
        				{{csrf_field()}}
        				{{method_field('PUT')}}
    				</form>
      			</div>
    		</div>
  		</div>
  </div>
  <!-- /.modal -->



		<div class="modal fade" id="hapus_resep">
  	<div class="modal-dialog">
  		<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Data</h4>
            </div>
        	<div class="modal-body">
            	<p>Hapus Resep&hellip;</p>
        		<form name="form_hapus_resep" class="form-horizontal" action="{{url('lihat_obat/hapus')}}" method="post" enctype="multipart/form-data">
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
	
	function hapus_resep(id){
	document.forms['form_hapus_resep']['id'].value=id;
    $('#hapus_resep').modal('show');
	}
	
    function ubah_resep(id, tanggal_pemakaian, nama_obat, dosis, jumlah_obat){
      document.forms['form_edit_resep']['id'].value=id;
      document.forms['form_edit_resep']['tanggal_pemakaian'].value=tanggal_pemakaian;
      document.forms['form_edit_resep']['nama_obat'].value=nama_obat;
      document.forms['form_edit_resep']['dosis'].value=dosis;
      document.forms['form_edit_resep']['jumlah_obat'].value=jumlah_obat;
      $('#ubah_resep').modal('show');
    }
   
    
</script>
@endsection