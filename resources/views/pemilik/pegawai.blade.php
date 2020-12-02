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
@if($errors->has('username'))
<div class="alert alert-danger" role="alert"> {{$errors->first('username')}} </div>
@endif
@if($errors->has('nama'))
<div class="alert alert-danger" role="alert"> {{$errors->first('nama')}} </div>
@endif
@if($errors->has('password'))
<div class="alert alert-danger" role="alert"> {{$errors->first('password')}} </div>
@endif
<title>Daftar pegawai</title>
<section class="content-header">
<div class="row"> 
  <div class="col-md-6">
    <h3><b>Daftar Pegawai</b></h3>
  </div>
  <div class="col-md-4">
    
  </div>
  <div class="col-md-2 text-right">
    <button onclick="tambah_pegawai()" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah pegawai</button>
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
                  <th>Username</th>
                  <th>Nama</th>
                  <th>Password</th>
                  <th width="50"></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 1;
                ?>
                @foreach($data as $dtpegawai)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $dtpegawai->username }}</td>
                  <td>{{ $dtpegawai->nama }}</td>
                  <td>{{ $dtpegawai->password }}</td>
                  <td>
                  <button onclick="hapus_pegawai('{{$dtpegawai->id}}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</button>
                </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            
            </div>
            </div>
            </div>


  <!-- Modal Edit pegawai -->
    <div class="modal fade" id="tambah_pegawai">
      <div class="modal-dialog" role="document" style="width: 60%">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambah Data Pegawai</h4>
            </div>
            <div class="modal-body">
            <form name="form_tambah_pegawai" class="form-horizontal" action="{{url('/tambah_pegawai')}}" method="post">
           </div>
                <div class="form-group">
                  <label for="inputusername" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <input type="input" class="form-control" name="username" required="">
                    </div>
        </div><br><br>
                <div class="form-group">
            <label for="inputnama" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
              <input type="input" class="form-control" name="nama" required="">
            </div>
        </div><br><br>
        <div class="form-group">
            <label for="inputnama" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name="password" required="">
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

 

  <div class="modal fade" id="hapus_pegawai">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Data</h4>
            </div>
          <div class="modal-body">
              <p>Apakah anda yakin ingin menghapus pegawai ini ?</p>
            <form name="form_hapus" class="form-horizontal" action="{{url('/hapus_pegawai')}}" method="post" enctype="multipart/form-data">
              @foreach($data as $dtpegawai)
              <input type="hidden" name="id" value="{{$dtpegawai->id}}">
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
function tambah_pegawai(){
      $('#tambah_pegawai').modal('show');
    }

 function hapus_pegawai(id){
  document.forms['form_hapus']['id'].value=id;
    $('#hapus_pegawai').modal('show');
  }
  
</script>
@endsection
