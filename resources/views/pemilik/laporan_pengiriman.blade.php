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
<title>Laporan Pengiriman</title>
<section class="content-header">
<div class="row"> 
  <div class="col-md-6">
    <h3><b>Laporan Pengiriman Barang</b></h3> 
  </div>
  <div class="col-md-4">
    
  </div>
  <div class="col-md-2 text-right">
    <button onclick="tambah_pengiriman()" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah pengiriman</button>
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
                  <button onclick="hapus_pengiriman('{{$dtpengiriman->id}}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</button>
                </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            
            </div>
            </div>
            </div>


  <!-- Modal Edit pengiriman -->
    <div class="modal fade" id="tambah_pengiriman">
      <div class="modal-dialog" role="document" style="width: 60%">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambah Data Pengiriman</h4>
            </div>
            <div class="modal-body">
            <form name="form_tambah_pengiriman" class="form-horizontal" action="{{url('/tambahpengiriman')}}" method="post">
           </div>
        <div class="form-group">
          <label for="inputusername" class="col-sm-2 control-label">Jumlah Barang Dikirim</label>
            <div class="col-sm-10">
              <input type="input" class="form-control" name="jumlah_barang_masuk" required="">
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

 

  <div class="modal fade" id="hapus_pengiriman">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Data</h4>
            </div>
          <div class="modal-body">
              <p>Apakah anda yakin ingin menghapus data pengiriman ini ?</p>
            <form name="form_hapus" class="form-horizontal" action="{{url('/hapuspengiriman')}}" method="post" enctype="multipart/form-data">
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

 function hapus_pengiriman(id){
  document.forms['form_hapus']['id'].value=id;
    $('#hapus_pengiriman').modal('show');
  }
  
</script>
@endsection
