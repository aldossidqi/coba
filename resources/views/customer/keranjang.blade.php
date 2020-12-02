<!DOCTYPE html>
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
<html lang="en">
  <head>
    <title>E-Commerce Toko DRESSCODE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="/css/animate.css">
    
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/css/magnific-popup.css">

    <link rel="stylesheet" href="/css/aos.css">

    <link rel="stylesheet" href="/css/ionicons.min.css">
    
    <link rel="stylesheet" href="/css/flaticon.css">
    <link rel="stylesheet" href="/css/icomoon.css">
    <link rel="stylesheet" href="/css/style.css">
  </head>
  <body>
	  <div class="bg-top navbar-light">
    	<div class="container">
    		<div class="row no-gutters d-flex align-items-center align-items-stretch">
    			<div class="col-md-4 d-flex align-items-center py-4">
    				<a class="navbar-brand" href="/">DAGANG ONLINE <span>Toko DressCode</span></a>
    			</div>
	    		<div class="col-lg-8 d-block">
		    		<div class="row d-flex">
					    <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
					    	<div class="icon d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
					    	<div class="text">
					    		<span>Email</span>
						    	<span>dresscode@gmail.com</span>
						    </div>
					    </div>
					    <div class="col-md d-flex topper align-items-center align-items-stretch py-md-4">
					    	<div class="icon d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
						    <div class="text">
						    	<span>Phone</span>
						    	<span>0341-721788</span>
						    </div>
					    </div>
					    <div class="col-md topper d-flex align-items-center justify-content-end">
					    </div>
				    </div>
			    </div>

		    </div>
		  </div>
    </div>
	  <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container d-flex align-items-center px-4">
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav mr-auto">
	        	<li class="nav-item active"><a href="{{url('/situs_online/'.$user)}}" class="nav-link pl-0">Home</a></li>
            
	        </ul>
          <ul class="navbar-nav">
          <li class="nav-item"><a href="/logout" class="nav-link pl-0">Keluar</a></li>
          </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
    <div class="col-md-12">
      <br>
      <b style="font-size: 30px;"><p style="text-align: center;">Keranjang Barang</p></b>
      <table class="table table-hover table-bordered" >
              <thead>
                <tr>
                  <th width="10">No</th>
                  <th>ID Barang</th>
                  <th>Gambar</th>
                  <th>Harga Barang</th>
                  <th width="30" style="text-align: center;">Jumlah Barang</th>
                  <th width="30" > </th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $no = 1;
                ?>
                @foreach($data as $barang)
                <tr>
                  
                  <td>{{ $no++ }}</td>
                  <td>{{ $barang->barang_id }}</td>
                  <td><img src="/gambarbrg/{{$barang->gambar}}" alt="image"
                        style="max-height: 200px; max-width: 200px;"/></td>
                  <td>
                    Rp {{ $barang->harga }} / item <br>
                    Total = Rp {{ $barang->total_harga }}
                  </td>
                  <td>
                    

                    <div class="col-md-12 text-center">
                      {{ $barang->jumlah_dibeli }}<br>
                      <button onclick="jumlah('{{ $barang->id }}','{{ $barang->jumlah_dibeli }}','{{ $barang->harga }}')" class="btn btn-primary"><i class="fa fa-plus"></i> Ubah</button>
                    </div>
                  </div></td>
                  <td><br>
                    <form name="form_hapus" class="form-horizontal" action="{{url('/hapusbeli/'.$user.'/'.$barang->id)}}" method="post" enctype="multipart/form-data">
                      <input type="submit" class="btn btn-danger btn-xs" value="Hapus">
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
                    </form>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tbody>
                <td colspan="3"></td>
                <td >Total yang harus dibayar : Rp {{ $totalsemua }}</td>
               <td>
                
                   <button onclick="confirm('{{ $customer->id }}','{{ $customer->nama_customer }}','{{ $customer->email }}','{{ $customer->no_hp }}','{{ $customer->alamat }}')" class="btn btn-warning"><i class="fa fa-plus"></i> Konfirmasi</button>

                  </td>
              </tbody>
            </table>
		</div>
		
		
    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
			  <p>Toko Dresscode Uda Aldo</p>
          </div>
        </div>
      </div>
    </footer>
    
  <!-- Modal tambah barang -->
    <div class="modal fade" id="jumlah">
      <div class="modal-dialog" role="document" style="width: 100%">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
            <form name="form_jumlah" class="form-horizontal" action="{{url('/updatekeranjang/'.$user)}}" method="post" enctype="multipart/form-data">
           </div>
              <input type="hidden" name="id">
              <input type="hidden" name="harga">
                        
        <div class="form-group">
          <label for="inputnip" class="col-sm-4 control-label">Jumlah Barang</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" name="jumlah_dibeli" required="">
              @if($errors->has('dibeli'))
              <div class="alert alert-danger" role="alert"> {{$errors->first('dibeli')}} </div>
              @endif
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
  </div>
  <!-- /.modal -->

   <!-- Modal konfirmasi pembelian -->
    <div class="modal fade" id="confirm">
      <div class="modal-dialog" role="document" style="width: 100%">
        <div class="modal-content">
            <div class="modal-header">
              <b>Identitas Penerima</b>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
            <form name="konfirmasi" class="form-horizontal" action="{{url('/rekapkeranjang/'.$user)}}" method="post" enctype="multipart/form-data">
           </div>
              <input type="hidden" name="id">
        <div class="form-group">
          <label for="inputnip" class="col-sm-4 control-label">Nama Penerima</label>
            <div class="col-sm-10">
              <input type="text" name="nama_customer" placeholder="Masukan Nama" class="form-control" value="{{$customer->nama_customer}}"> <br>
            </div>
        </div><br><br>
        <div class="form-group">
          <label for="inputnip" class="col-sm-4 control-label">Email Penerima</label>
            <div class="col-sm-10">
              <input type="text" name="email" placeholder="Masukan Email" class="form-control" value="{{$customer->email}}"> <br>
            </div>
        </div><br><br>
        <div class="form-group">
          <label for="inputnip" class="col-sm-4 control-label">No HP Penerima</label>
            <div class="col-sm-10">
              <input type="text" name="no_hp" placeholder="Masukan Nomor Handphone" class="form-control" value="{{$customer->no_hp}}"> <br>
            </div>
        </div><br><br>
        <div class="form-group">
          <label for="inputnip" class="col-sm-4 control-label">Alamat Pengiriman</label>
            <div class="col-sm-10">
              <input type="text" name="alamat" placeholder="Masukan Alamat" class="form-control" value="{{$customer->alamat}}"> <br>
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
  </div>
  <!-- /.modal -->

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="/js/jquery.min.js"></script>
  <script src="/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="/js/popper.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/jquery.easing.1.3.js"></script>
  <script src="/js/jquery.waypoints.min.js"></script>
  <script src="/js/jquery.stellar.min.js"></script>
  <script src="/js/owl.carousel.min.js"></script>
  <script src="/js/jquery.magnific-popup.min.js"></script>
  <script src="/js/aos.js"></script>
  <script src="/js/jquery.animateNumber.min.js"></script>
  <script src="/js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="/js/google-map.js"></script>
  <script src="/js/main.js"></script>
  <script >
    function jumlah(id, jumlah_dibeli, harga){
      document.forms['form_jumlah']['id'].value=id;
      document.forms['form_jumlah']['jumlah_dibeli'].value=jumlah_dibeli;
      document.forms['form_jumlah']['harga'].value=harga;

      $('#jumlah').modal('show');
      
    }
    function confirm(id, nama_customer, email, no_hp, alamat){
      document.forms['konfirmasi']['id'].value=id;
      document.forms['konfirmasi']['nama_customer'].value=nama_customer;
      document.forms['konfirmasi']['email'].value=email;
      document.forms['konfirmasi']['no_hp'].value=no_hp;
      document.forms['konfirmasi']['alamat'].value=alamat;
      $('#confirm').modal('show');
    }

    function hapus(id){
      document.forms['form_hapus']['id'].value=id;
      $('#hapus').modal('show');
      
    }
  </script>
  </body>
</html>