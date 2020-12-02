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
<title>Laporan</title>
<section class="content-header">
<div class="row"> 
  <div class="col-md-6">
    <h3><b>Laporan Penjualan</b> @if($data1) <button onclick="hapus_laporan('{{$data1->id}}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</button></h3> @endif
  </div>
  <div class="col-md-4">
    
  </div>
  <div class="col-md-2 text-right">
    <button onclick="tambah_laporan()" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah laporan</button>
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
                  <th>Uang Masuk</th>
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
                  <td>Rp {{ $dtlaporan->jumlah_uang_masuk }}</td>
                  <td>{{ $dtlaporan->tanggal }}</td>
                  
                </tr>
                @endforeach
              </tbody>
            </table>
            
            </div>
            </div>
            </div>


  <!-- Modal Edit laporan -->
    <div class="modal fade" id="tambah_laporan">
      <div class="modal-dialog" role="document" style="width: 60%">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambah Data laporan</h4>
            </div>
            <div class="modal-body">
            <form name="form_tambah_laporan" class="form-horizontal" action="{{url('/tambahlaporan')}}" method="post">
           </div>
                <div class="form-group">
                  <label for="inputusername" class="col-sm-2 control-label">ID Barang</label>
                    <div class="col-sm-10">
                      <input type="input" class="form-control" name="id_barang" required="">
                    </div>
        </div><br><br>
                <div class="form-group">
            <label for="inputnama" class="col-sm-2 control-label">Jumlah Terjual</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" name="jumlah_barang_terjual" required="">
            </div>
        </div><br><br>
        <div class="form-group">
            <label for="inputnama" class="col-sm-2 control-label">Jumlah Uang Masuk</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" name="jumlah_uang_masuk" required="">
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

 

  <div class="modal fade" id="hapus_laporan">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Data</h4>
            </div>
          <div class="modal-body">
              <p>Apakah yakin ingin menghapus data yang terakhir anda masukan ?</p>
            <form name="form_hapus" class="form-horizontal" action="{{url('/hapuslaporan')}}" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id">
              @foreach($data as $dtlaporan)
                <input type="hidden" name="id_barang" value="{{ $dtlaporan->id_barang }}">
                <input type="hidden" name="jumlah_barang_terjual" value="{{ $dtlaporan->jumlah_barang_terjual }}">
              @endforeach
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
function tambah_laporan(){
      $('#tambah_laporan').modal('show');
    }

 function hapus_laporan(id){
  document.forms['form_hapus']['id'].value=id;
    $('#hapus_laporan').modal('show');
  }
  
</script>
@endsection
