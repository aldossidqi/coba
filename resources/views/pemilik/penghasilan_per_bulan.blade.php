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
@if($errors->has('id_barang'))
<div class="alert alert-danger" role="alert"> {{$errors->first('id_barang')}} </div>
@endif
@if($errors->has('jumlah_barang_terjual'))
<div class="alert alert-danger" role="alert"> {{$errors->first('jumlah_barang_terjual')}} </div>
@endif
@if($errors->has('jumlah_uang_masuk'))
<div class="alert alert-danger" role="alert"> {{$errors->first('jumlah_uang_masuk')}} </div>
@endif
<title>Barang Terjual Online</title>
<section class="content-header">
<div class="row"> 
  <div class="col-md-6">
    <h3><b>Barang Terjual Pada Bulan <?php 
                  $x =  $tanggal;
                  
                  $y = substr($x, 5, 2);
                  if ($y == "01" ){
                    echo " Januari ";
                  } elseif ($y == "02") {
                    echo " Februari ";
                  } elseif ($y == "03") {
                    echo " Maret ";
                  } elseif ($y == "04") {
                    echo " April ";
                  } elseif ($y == "05") {
                    echo " Mei ";
                  } elseif ($y == "06") {
                    echo " Juni ";
                  } elseif ($y == "07") {
                    echo " July ";
                  } elseif ($y == "08") {
                    echo " Agustus ";
                  } elseif ($y == "09") {
                    echo " September ";
                  } elseif ($y == "10") {
                    echo " Oktober ";
                  } elseif ($y == "11") {
                    echo " November ";
                  } elseif ($y == "12") {
                    echo " Desember ";
                  }
                  $thn = substr($x, 0, 4);
                  echo $thn;
                  ?></b></h3>
  </div>
  <div class="col-md-4">
    
  </div>
  
</div>
</section>

<section class="content">
  <div class="row">
        <div class="col-md-12">
        <div class="box">
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped" >
              <thead>
                <tr>
                  <th width="10">No</th>
                  <th>ID Barang</th>
                  <th>Gambar</th>
                  <th>Jumlah Barang</th>
                  <th>Total Harga </th>
                  <th>Tanggal Terjual</th>
                  <th></th>

                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 1;
                ?>
                @foreach($data as $verif)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $verif->barang_id }}</td>
                  <td><img src="/gambarbrg/{{$verif->gambar}}" alt="image"
                        style="max-height: 200px; max-width: 200px;"/></td>
                  <td width="50">{{ $verif->jumlah_dibeli }}</td>
                  <td>{{ $verif->harga }}</td>
                  <td><?php 
                  $x =  $verif->tanggal_beli;
                  $tgl  = substr($x, 8,2);
                  echo $tgl ;
                  $y = substr($x, 5, 2);
                  if ($y == "01" ){
                    echo " Januari ";
                  } elseif ($y == "02") {
                    echo " Februari ";
                  } elseif ($y == "03") {
                    echo " Maret ";
                  } elseif ($y == "04") {
                    echo " April ";
                  } elseif ($y == "05") {
                    echo " Mei ";
                  } elseif ($y == "06") {
                    echo " Juni ";
                  } elseif ($y == "07") {
                    echo " July ";
                  } elseif ($y == "08") {
                    echo " Agustus ";
                  } elseif ($y == "09") {
                    echo " September ";
                  } elseif ($y == "10") {
                    echo " Oktober ";
                  } elseif ($y == "11") {
                    echo " November ";
                  } elseif ($y == "12") {
                    echo " Desember ";
                  }
                  $thn = substr($x, 0, 4);
                  echo $thn;
                  ?></td>
                  <td>
                    <button onclick="lihat('{{ $verif->id }}','{{ $verif->nama_customer }}','{{ $verif->email }}','{{ $verif->no_hp }}','{{ $verif->alamat }}')" class="btn btn-warning btn-xs "><i class="fa fa-eye"></i> Lihat</button>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tbody>
                <td colspan="3" style="text-align: center;">Jumlah </td>
                @foreach($totalx as $jml)
                <td >{{ $jml->total }}</td>
                @endforeach
                
                @foreach($total as $jml)
                <td >Rp {{ $jml->total }}</td>
                @endforeach
                
                </td>
                
              </tbody>
            </table>
            
            </div>
            </div>
            </div>


<div class="modal fade" id="lihat">
      <div class="modal-dialog" role="document" style="width: 60%">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Lihat</h4>
            </div>
            <div class="modal-body">
            <form name="form_lihat" class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
           </div>
           <input type="hidden" name="id" >
           
        <div class="form-group">
          <label for="inputnip" class="col-sm-2 control-label">Nama Customer</label>
            <div class="col-sm-10">
              <input type="input" class="form-control" name="nama_customer" readonly="" >
            </div>
        </div><br><br>
        <div class="form-group">
            <label for="inputnama" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="input" class="form-control" name="email" readonly="" >
            </div>
        </div><br><br>
        <div class="form-group">
            <label for="inputnama" class="col-sm-2 control-label">Nomor HP</label>
            <div class="col-sm-10">
              <input type="input" class="form-control" name="no_hp" readonly="" >
            </div>
        </div><br><br>
        <div class="form-group">
            <label for="inputnama" class="col-sm-2 control-label">Alamat </label>
            <div class="col-sm-10">
              <input type="input" class="form-control" name="alamat" readonly="" >
              
            </div>
        </div><br><br>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
        </div>
           
              </form>
            </div>
        </div>
      </div>
  
  <!-- /.modal -->

</section>

@endsection

@section('script')

<script>
  $(function () {
    $('#example1').DataTable({
      'searching'   : true
    })
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })

function lihat( id, nama_customer, email, no_hp, alamat){
  
  document.forms['form_lihat']['id'].value=id;
  document.forms['form_lihat']['nama_customer'].value=nama_customer;
  document.forms['form_lihat']['email'].value=email;
  document.forms['form_lihat']['no_hp'].value=no_hp;
  document.forms['form_lihat']['alamat'].value=alamat;
    $('#lihat').modal('show');
  }

</script>
@endsection
