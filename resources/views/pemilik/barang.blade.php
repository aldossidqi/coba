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
<title>Data Barang</title>
<section class="content-header">
<div class="row"> 
  <div class="col-md-6">
    <h3><b>Daftar Barang</b></h3>
  </div>
  <div class="col-md-4">
    
  </div>
  <div class="col-md-2 text-right">
    <button onclick="tambah_barang()" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah barang</button>
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
                  <th>Total Dilihat</th>
                  <th>Harga</th>
                  <th width="100"></th>
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
                  <td>{{ $barang->total_dilihat }}</td>
                  <td>Rp {{ $barang->harga }}</td>
                  <td>
                  <button onclick="ubah_barang('{{ $barang->id_barang }}','{{ $barang->gambar }}','{{ $barang->jumlah_barang }}','{{ $barang->jenis }}','{{ $barang->harga }}','{{ $barang->warna }}','{{ $barang->total_dilihat }}')" class="btn btn-warning btn-xs "><i class="fa fa-edit"></i> Ubah</button>
                  <button onclick="hapus_barang('{{$barang->id_barang}}')" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</button>
                </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            
            </div>
            </div>
            </div>


  <!-- Modal tambah barang -->
    <div class="modal fade" id="tambah_barang">
      <div class="modal-dialog" role="document" style="width: 60%">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambah Data barang</h4>
            </div>
            <div class="modal-body">
            <form name="form_tambah_barang" class="form-horizontal" action="{{url('/tambahbarang')}}" method="post" enctype="multipart/form-data">
           </div>
          
        <div class="form-group">
          <label for="inputnip" class="col-sm-2 control-label">ID barang</label>
            <div class="col-sm-10">
              <input type="input" class="form-control" name="id_barang" required="">
            </div>
        </div><br><br>
        <div class="form-group">
            <label for="inputnama" class="col-sm-2 control-label">Gambar</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" name="gambar" required="">
            </div>
        </div><br><br>
        <div class="form-group">
            <label for="inputnama" class="col-sm-2 control-label">Jumlah</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" name="jumlah_barang" required="">
              @if($errors->has('jumlah_barang'))
              <div class="alert alert-danger" role="alert"> {{$errors->first('jumlah_barang')}} </div>
              @endif
            </div>
        </div><br><br>
        <div class="form-group">
            <label for="inputnama" class="col-sm-2 control-label">Jenis Barang </label>
            <div class="col-sm-10">
             <select  name="jenis" class="form-control">
                <option value="Baju">Baju</option>
                <option value="Rok">Rok</option>
                <option value="Celana">Celana</option>
                <option value="Jaket">Jaket</option>
              </select>
            </div>
        </div><br><br>
        <div class="form-group">
            <label for="inputnama" class="col-sm-2 control-label">Harga </label>
            <div class="col-sm-10">
              <input type="input" class="form-control" name="harga" required="" id="rupiah">
              @if($errors->has('harga'))
              <div class="alert alert-danger" role="alert"> {{$errors->first('harga')}} </div>
              @endif
            </div>
        </div><br><br>
        <div class="form-group">
            <label for="inputnama" class="col-sm-2 control-label">Warna </label>
            <div class="col-sm-10">
              <input type="input" class="form-control" name="warna" required="">
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

<div class="modal fade" id="ubah_barang">
      <div class="modal-dialog" role="document" style="width: 60%">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Ubah Data barang</h4>
            </div>
            <div class="modal-body">
            <form name="form_edit" class="form-horizontal" action="{{url('/ubahbarang/')}}" method="post" enctype="multipart/form-data">
           </div>
           @foreach($data as $barang)
           <input type="hidden" name="total_dilihat" value="{{$barang->total_dilihat}}">
           @endforeach
        <div class="form-group">
          <label for="inputnip" class="col-sm-2 control-label">ID barang</label>
            <div class="col-sm-10">
              <input type="input" class="form-control" name="id_barang" required="">
            </div>
        </div><br><br>
        <div class="form-group">
            <label for="inputnama" class="col-sm-2 control-label">Gambar</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" name="gambar" >
            </div>
        </div><br><br>
        <div class="form-group">
            <label for="inputnama" class="col-sm-2 control-label">Jumlah</label>
            <div class="col-sm-10">
              <input type="input" class="form-control" name="jumlah_barang" required="">
              @if($errors->has('jumlah_barang'))
              <div class="alert alert-danger" role="alert"> {{$errors->first('jumlah_barang')}} </div>
              @endif
            </div>
        </div><br><br>
        <div class="form-group">
            <label for="inputnama" class="col-sm-2 control-label">Jenis Barang </label>
            <div class="col-sm-10">
              <select  name="jenis" class="form-control">
                <option value="Baju">Baju</option>
                <option value="Rok">Rok</option>
                <option value="Celana">Celana</option>
                <option value="Jaket">Jaket</option>
              </select>
            </div>
        </div><br><br>
        <div class="form-group">
            <label for="inputnama" class="col-sm-2 control-label">Harga </label>
            <div class="col-sm-10">
              <input type="input" class="form-control" name="harga" required="" id="rupiah1">
              @if($errors->has('harga'))
              <div class="alert alert-danger" role="alert"> {{$errors->first('harga')}} </div>
              @endif
            </div>
        </div><br><br>
        <div class="form-group">
            <label for="inputnama" class="col-sm-2 control-label">Warna </label>
            <div class="col-sm-10">
              <input type="input" class="form-control" name="warna" required="">
            </div>
        </div><br><br>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
          <input type="submit" class="btn btn-warning" value="Simpan">
        </div>
                {{csrf_field()}}
                {{method_field('PUT')}}
              </form>
            </div>
        </div>
      </div>
  
  <!-- /.modal -->

 

  <div class="modal fade" id="hapus_barang">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Hapus Data</h4>
            </div>
          <div class="modal-body">
              <p>Apakah anda yakin ingin menghapus barang ini ?</p>
            <form name="form_hapus" class="form-horizontal" action="{{url('/hapusbarang')}}" method="post" enctype="multipart/form-data">
              <input type="hidden" name="id_barang">
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
function tambah_barang(){
      $('#tambah_barang').modal('show');
    }

function ubah_barang( id_barang, gambar, jumlah_barang, jenis, harga, warna, total_dilihat){
  
  document.forms['form_edit']['id_barang'].value=id_barang;
  document.forms['form_edit']['gambar'].src="/gambarbrg/"+gambar;
  document.forms['form_edit']['jumlah_barang'].value=jumlah_barang;
  document.forms['form_edit']['jenis'].value=jenis;
  document.forms['form_edit']['harga'].value=harga;
  document.forms['form_edit']['warna'].value=warna;
  document.forms['form_edit']['total_dilihat'].value=total_dilihat;
    $('#ubah_barang').modal('show');
  }

 function hapus_barang(id_barang){
  document.forms['form_hapus']['id_barang'].value=id_barang;
    $('#hapus_barang').modal('show');
  }
  
</script>

<script type="text/javascript">
        
      var rupiah = document.getElementById("rupiah");
      rupiah.addEventListener("keyup", function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, "Rp. ");
      });
      

      /* Fungsi formatRupiah */
      function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
          split = number_string.split(","),
          sisa = split[0].length % 3,
          rupiah = split[0].substr(0, sisa),
          ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
          separator = sisa ? "." : "";
          rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? " " + rupiah : "";
      }
    </script>


 <script type="text/javascript">
        
      var rupiah1 = document.getElementById("rupiah1");
      rupiah1.addEventListener("keyup", function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah1() untuk mengubah angka yang di ketik menjadi format angka
        rupiah1.value = formatRupiah(this.value, "Rp. ");
      });
      

      /* Fungsi formatRupiah */
      function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
          split = number_string.split(","),
          sisa = split[0].length % 3,
          rupiah = split[0].substr(0, sisa),
          ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
          separator = sisa ? "." : "";
          rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? " " + rupiah : "";
      }
    </script>
@endsection
