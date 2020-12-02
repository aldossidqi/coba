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

<title>Tahun Pelaporan Data</title>
<head>
  <style>
    #wrapper {
         margin: 200px auto;
    }
</style>
</head>
<section class="content-header">
<div class="row"> 
  <div class="col-md-6">
  
  </div>
  <div class="col-md-4">
    
  </div>
  
</div>
</section>

<section class="content" id="wrapper">
  <div class="row">
    <div class="col-md-2"></div>
        <div class="col-md-8">
        <div class="box">
          <div class="box-body">
             <div class="col-md-12"><br>
              <b><p style="font-size: 20px">Pilih Tahun - Bulan data penjualan yang ingin di cek: </p></b><br>
                <form action="{{url('/pilih_tanggal/')}}" method="post">
                  {{csrf_field()}}
                  <div class="input-group">
                      <select name="tanggal" class="form-control">
                        @foreach($data_tanggal as $t)
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
function tambah_pengeluaran(){
      $('#tambah_pengeluaran').modal('show');
    }

function ubah_pengeluaran(id, id_pegawai,  pengeluaran_rutin, pengeluaran_lainnya){
  document.forms['form_edit']['id'].value=id;
  document.forms['form_edit']['id_pegawai'].value=id_pegawai;
  document.forms['form_edit']['pengeluaran_rutin'].value=pengeluaran_rutin;
  document.forms['form_edit']['pengeluaran_lainnya'].value=pengeluaran_lainnya;
  
    $('#ubah_pengeluaran').modal('show');
  }

 function hapus_pengeluaran(id){
  document.forms['form_hapus']['id'].value=id;
    $('#hapus_pengeluaran').modal('show');
  }
  
</script>
@endsection
