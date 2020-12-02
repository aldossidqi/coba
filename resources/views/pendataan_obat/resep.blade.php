<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Laporan Obat Pasien</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <div style="width: 700px">
  	<div class="row">
  		<div>
  			<img src="{{public_path('background/logo_kabupaten.png')}}" alt="logo" style="width: 50px; margin-left:25px; margin-top: -20px">
		</div>
		<div>
			<img src="{{public_path('background/logo.png')}}" alt="logo" style="width: 90px; margin-left:590px; margin-top: -65px; margin-right: 25px" >
		</div>
  		<div style="text-align: center;" style="margin-right: 25px">
  			<h5 style="margin-top: -80px">PEMERINTAH KABUPATEN KARAWANG</h5>
  			<h5 style="margin-top: -20px">BADAN LAYANAN UMUM DAERAH</h5>
  			<h5 style="margin-top: -20px">RUMAH SAKIT UMUM DAERAH KELAS B NON PENDIDIKAN</h5>
  			<p style="margin-top: -20px"><font size="1"> Jl. Galuh Mas Raya No. 1 Sukaharja Telukjambe Timur</font></p>
  			<p style="margin-top: -15px"><font size="1">Telp. (0267) 640444, 640555 Fax. (0267) 640666</font></p>
  			<p style="margin-top: -15px"><font size="1">KARAWANG</font></p>
  			<hr style="border-width: 2px; margin-top: -10px">
  			<hr style="border-width: 1px; margin-top: -7px">
  		</div>
  		
  	</div>
  	
  </div>
</head>

<body style="width: 800px">
	<div style="width: 50%">
		<p style="margin-left: 25px"><i>dr.</i> &#160;&#160; .........................................................................</p>
		<br>
		@foreach($tanggal as $data)
		<table style="margin-left: 18px" width="100%">
			<tbody >
				<tr>
					<td>R/&#160; {{ $data->nama_obat }}  <td style="text-align: right;">&#160;&#160;&#160;&#160;{{ $data->jumlah_obat }}</td>
				</tr>
				<tr>
					<td> &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160; S {{ $data->dosis }}</td>
				</tr>
				
			</tbody>
		</table>
		@endforeach
	</div>

	<br><br>
	
</body>
<footer>
	<div style="position: fixed;bottom: 80">
	<table style="margin-left: 18px">
			<tr>
				<td>Nama Pasien <td>: {{$pasien->nama}}</td></td>
			</tr>
			<tr>
				<td>Nomor RM <td>: {{$pasien->nomorRM}}</td></td>
			</tr>
			<tr>
				<td>Umur <td>: {{$pasien->umur}}</td></td>
			</tr>
			<tr>
				<td>Tanggal Penggunaan <td>: {{$cari}}</td></td>
			</tr>
		</table>
		</div>
</footer>
</html>