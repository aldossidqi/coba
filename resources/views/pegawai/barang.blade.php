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

<title>Data Barang</title>
<section class="content-header">
<div class="row"> 
  <div class="col-md-6">
    <h3><b>Daftar Barang</b></h3>
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
                  <th>ID barang</th>
                  <th>Gambar</th>
                  <th>Jumlah</th>
                  <th>Jenis</th>
                  <th>Harga</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 1;
                ?>
                @foreach($data as $barang)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $barang->id_barang }}</td>
                  <td><img src="/gambarbrg/{{$barang->gambar}}" alt="image"
                        style="max-height: 200px; max-width: 200px;"/></td>
                  <td>{{ $barang->jumlah_barang }}</td>
                  <td>{{ $barang->jenis }}</td>
                  <td>Rp {{ $barang->harga }}</td>
                  
                </tr>
                @endforeach
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