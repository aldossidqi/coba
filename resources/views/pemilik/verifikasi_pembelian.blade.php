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
<title>Verifikasi Pembelian</title>
<section class="content-header">
<div class="row"> 
  <div class="col-md-6">
    <h3><b>Verifikasi Pembelian</b></h3>
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
                  <th>ID Transaksi</th>
                  <th>Gambar</th>
                  <th>Jumlah Pembayaran</th>
                  <th width="75"></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 1;
                ?>
                @foreach($data as $verif)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $verif->id_transaction }}</td>
                  <td><img src="/buktibayar/{{$verif->bukti_bayar}}" alt="image"
                        style="max-height: 200px; max-width: 200px;"/></td>
                  <td >Rp {{ $verif->total_harga }}</td>
                  <td>
                  <!--<button onclick="verifikasi('{{$verif->id}}','{{ $verif->barang_id }}')" class="btn btn-warning btn-xs"><i class="fa fa-check"></i> Verifikasi</button>-->
                  <button onclick="verifikasi('{{$verif->id_transaction}}')" class="btn btn-warning btn-xs"><i class="fa fa-check"></i> Verifikasi</button>
                </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            
            </div>
            </div>
            </div>


<div class="modal fade" id="verifikasi">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Verifikasi Jumlah Barang</h4>
            </div>
          <div class="modal-body">
              <p>Apakah anda yakin ini melakukan verifikasi pembayaran ini ?</p>
            <form name="form_verif" class="form-horizontal" action="{{url('/verifikasibarang')}}" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id_transaction" >
              <div class="modal-footer">
                    <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-warning" value="Verifikasi">
              </div>
              {{csrf_field()}}
              {{method_field('PUT')}}
            </form>
          </div>
          </div>
    <!-- /.modal-content -->
    </div>
   <!-- /.modal-dialog -->
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

function verifikasi(id_transaction){
  document.forms['form_verif']['id_transaction'].value=id_transaction;
    $('#verifikasi').modal('show');
  }
  
</script>
@endsection
