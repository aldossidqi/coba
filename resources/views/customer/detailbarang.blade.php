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
      @if($data)
    <table style="width: 100%" class="table table-hover table-bordered">
      <tr><th colspan="3" style="text-align: center;">Detail Barang</th></tr>
      <tr ><td rowspan="3" style="text-align: center;" width="750"><br>
            <img name="foto" src="{{url('gambarbrg/'.$data->gambar)}}" 
            style="max-height: 400px; max-width: 400px; text-align: center;"/>
          </td>
        </tr>
        <tr> 
          <td colspan="2" style="font-family: andalus">
            Jenis :  {{$data->jenis}} <br>
            Warna :  {{$data->warna}} <br>
            Sisa :  {{$data->jumlah_barang}} <br>
            Ukuran :  Semua Ukuran <br>
            Harga : Rp {{$data->harga}} <br><br>
            <a href="{{url('/belibarang/'.$user.'/'.$data->id_barang)}}" class="btn btn-danger btn-xs" >Beli</a>
            <span>
            <form name="form_tambah" class="form-horizontal" action="{{url('/tambahkeranjang/'.$user.'/'.$data->id_barang)}}" method="post" enctype="multipart/form-data">
              <input type="hidden" name="user_id" value="{{auth()->guard('customer')->user()->username}}">
              <input type="hidden" name="barang_id" value="{{$data->id_barang}}">
              <input type="hidden" name="harga" value="{{$data->harga}}">
              <br><input type="submit" class="btn btn-warning btn-xs" value="Tambah Ke Keranjang">
                  {{csrf_field()}}
            </form></span>
         </td>
        </tr>
        
    </table>
    @endif
		</div>
		

<!-- 

    <section class="ftco-section ftco-consult ftco-no-pt ftco-no-pb" style="background-image: url(images/bg_5.jpg);" data-stellar-background-ratio="0.5">
    	<div class="container">
    		<div class="row justify-content-end">
    			<div class="col-md-6 py-5 px-md-5">
    				<div class="py-md-5">
		          <div class="heading-section heading-section-white ftco-animate mb-5">
		            <h2 class="mb-4">GALERY</h2>
					  <p>Galery diskominfo</p>
					  <p><a href="#" class="btn btn-primary px-4 py-3 mt-3">Telusuri</a></p>		          
					</div>
                  </div>
              </div>
		  </div>
		    					<div class="form-group ml-md-4">
			    				</div>
	  </div>
		    				<div class="d-md-flex">
			            </div>
			            <div class="form-group ml-md-4">
			            </div>
    </section> -->

		
    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
			  <p>Toko Dresscode Uda Aldo</p>
          </div>
        </div>
      </div>
    </footer>
    
  

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
  
  </body>
</html>