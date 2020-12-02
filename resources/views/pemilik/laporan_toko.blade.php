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
<title>Laporan</title>
<section class="content-header">
<div class="row"> 
  <div class="col-md-6">
    <h3><b>Laporan Penjualan</b></h3>
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
                  <th>Jumlah Laku</th>
                  <th>Harga Baju</th>
                  <th>Uang Masuk</th>
                  <th>Selisih</th>
                  <th>Tanggal Laku</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 1;
                ?>
                @foreach($data as $dtlaporan)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $dtlaporan->id_barang }}</td>
                  <td>{{ $dtlaporan->jumlah_barang_terjual }}</td>
                  <td>{{ $dtlaporan->harga }}</td>
                  <td>Rp {{ $dtlaporan->jumlah_uang_masuk }}</td>
                  <td>{{ $dtlaporan->harga - $dtlaporan->jumlah_uang_masuk }}</td>
                  <td><?php 
                  $x =  $dtlaporan->tanggal;
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
                  
                </tr>
                @endforeach
              </tbody>
              <tbody>
                <td colspan="3" style="text-align: center;">Jumlah Pendapatan</td>
                <td>
                @foreach($total as $jml)
                <td colspan="2">Rp {{ $jml->total }}</td>
                @endforeach
                
                </td>
              </tbody>
            </table>
            
            </div>
            </div>
            </div>




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

  
</script>
@endsection
