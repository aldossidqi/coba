<!DOCTYPE html>
<html>
<head>
  <title>Laporan Obat Pasien</title>
  <h3 style="text-align: center;">Laporan Obat Pasien</h3>
</head>

<body style="width: 800px">
	<div>
		<table>
			<tr>
				<th>Identitas Pasien</th>
			</tr>
			<tr>
				<td>Nomor RM <td>: {{$pasien->nomorRM}}</td></td>
			</tr>
			<tr>
				<td>Nama Pasien <td>: {{$pasien->nama}}</td></td>
			</tr>
			<tr>
				<td>Umur <td>: {{$pasien->umur}}</td></td>
			</tr>
			<tr>
				<td>Alamat <td>: {{$pasien->alamat}}</td></td>
			</tr>
			<tr>
				<td>Jenis Kelamin <td>: {{$pasien->kelamin}}</td></td>
			</tr>
		</table><br>
		<p>Obat yang pernah dikonsumsi pasien pada tanggal  {{$cari}}</p> 
		<table style="width:100%" border="1" cellspacing="0">
			<thead style="text-align: center;">
				<tr>
					<th>Nama Obat</th>
					<th>Dosis</th>
					<th>Jumlah Obat</th>
				</tr>
			</thead>
			<tbody style="text-align: center;">
				@foreach($tanggal as $data)
				<tr>
					<td>{{ $data->nama_obat }}</td>
					<td>{{ $data->dosis }}</td>
					<td>{{ $data->jumlah_obat }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</body>

</html>