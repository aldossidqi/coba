@extends('adminltepegawai')

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
<title>Verifikasi Pengiriman</title>
<section class="content-header">
<div class="row"> 
  <div class="col-md-6">
    <h3><b>Verifikasi Jumlah Barang</b></h3> 
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
                  <th>Jumlah Barang Dikirim</th>
                  <th>Tanggal Masuk</th>
                  <th>Status</th>
                  <th width="50"></th>
                  
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 1;
                ?>
                @foreach($data as $dtpengiriman)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $dtpengiriman->jumlah_barang_masuk }}</td>
                  <td>{{ $dtpengiriman->tanggal_masuk }}</td>
                  <td>{{ $dtpengiriman->status }}</td>
                  <td>
                    @if ($dtpengiriman->status=="Belum diverifikasi")
                  <button onclick="verifikasi_pengiriman('{{$dtpengiriman->id}}')" class="btn btn-warning btn-xs"><i class="fa fa-check-square-o"></i> Verifikasi</button> @endif
                </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            
            </div>
            </div>
            </div>

  <div class="modal fade" id="verifikasi_pengiriman">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Verifikasi Jumlah Barang</h4>
            </div>
          <div class="modal-body">
              <p>Apakah anda yakin jumlah barang masuk sudah sesuai dengan yang dikirimkan pemilik toko ?</p>
            <form name="form_hapus" class="form-horizontal" action="{{url('/verifikasipengiriman')}}" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id">
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
function tambah_pengiriman(){
      $('#tambah_pengiriman').modal('show');
    }

 function verifikasi_pengiriman(id){
  document.forms['form_hapus']['id'].value=id;
    $('#verifikasi_pengiriman').modal('show');
  }
  
</script>
@endsection
