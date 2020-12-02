<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\BarangModel;
use App\TransaksiModel;
use App\NomorTransaksiModel;
use App\CustomerModel;
use App\User;

class BeliController extends Controller
{
    
    public function situsonline($username)
    {
        $user = $username;
        $data = BarangModel::orderBy('created_at','asc')->get();
        return view ('customer/online',compact('data','user'));
    }

    public function detailbarang($username, $id)
    {
        $data = BarangModel::where("id_barang", $id)->first();
        $user = $username;

        $jml = $data->total_dilihat + 1;
        $barang = [
            'total_dilihat' => $jml,
            ];
        $pgw = BarangModel::where('id_barang',$id)->update($barang);
        return view ('customer/detailbarang',compact('data','user'));
    }

    public function formbelibarang($username,Request $request, $id)
    {
        $user = $username;
        $data = BarangModel::where("id_barang", $id)->first();
        return view ('customer/pembelian',compact('data','user'));
    }

    public function belibarang($username,Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
            $tgl=date('Y-m-d');
        $user = $username;

        $data = [
            'user_id' => $username,
            'nama_customer' => $request->nama_customer,
            'alamat'=> $request->alamat,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'barang_id' => $request->barang_id,
            'harga' => $request->harga ,
            'jumlah_dibeli' => $request->jumlah_dibeli,
            'status' => "Belum Terverifikasi",
            'keranjang' => "No",
            'tanggal_beli' => $tgl
          ];
         $beli = TransaksiModel::create($data);
         if($beli){
            $red = redirect('/upload_bukti/'.$user.'/'.$id)->with('success', 'Transaksi diterima, Silahkan Lakukan Pembayaran!');
        } 
        return $red;
    }

    public function formupload($username, $id)
    {
        $user = $username;
        $data = TransaksiModel::where("transaction_id", $id)->where("user_id", $user)->orderBy('created_at','desc')->get();
        foreach ($data as $hargaxx) {
        $a[] = $this->convert_to_angka($hargaxx->total_harga);
        }
        $maks = count(TransaksiModel::where("user_id", $user)->where("transaction_id", $id)->get());

        $totalsemua1 = 0;
        for($i = 0; $i<$maks; $i++){
            $totalsemua1 = $totalsemua1 + $a[$i];
        }
        $totalsemua = number_format($totalsemua1,0,',','.');

        return view ('customer/formupload',compact('data','user','totalsemua','id'));
    }

    public function uploadbukti($username,Request $request, $id)
    {
        $user = $username;
        date_default_timezone_set('Asia/Jakarta');
            $tgl=date('Y-m-d');
        $validator = $this->validate($request,[
            'bukti_bayar' => 'file|image|mimes:jpeg,png,gif,webp|max:2048',
            
        ],[
           
        ]); 
        $foto = $request->bukti_bayar;
        $bukti_bayar = $foto->getClientOriginalName();
        $foto->move('buktibayar', $bukti_bayar);
        $data = [
            'status'=> "Menunggu verifikasi"
            ];
        $trans = TransaksiModel::where('transaction_id',$request->id)->update($data);

        $data = [
            'bukti_bayar' => $bukti_bayar,
            'status'=> "Menunggu verifikasi"
            ];
        $no_trans = NomorTransaksiModel::where('id_transaction',$request->id)->update($data);
        return redirect('/situs_online/'.$user)->with('success', 'Transaksi berhasil, menunggu verifikasi dari admin');
    }

    public function pembelian($username)
    {
        $user = $username;
        $data = NomorTransaksiModel::where("user_id", $user)->get();
        return view ('customer/semuapembelian',compact('data','user'));
    }

    public function pembelian_detail($username, $transaction_id)
    {
        $user = $username;
        $data = DB::table('transaksi_models')->join('barang_models','barang_models.id_barang','=','transaksi_models.barang_id')->where('user_id',$username)->where('transaction_id',$transaction_id)->get();
        $total = TransaksiModel::where("transaction_id", $transaction_id)->where("user_id", $username)->orderBy('created_at','desc')->get();
        $status = TransaksiModel::where("transaction_id", $transaction_id)->where("user_id", $username)->orderBy('created_at','desc')->first();
        foreach ($total as $hargaxx) {
        $a[] = $this->convert_to_angka($hargaxx->total_harga);
        }
        $maks = count(TransaksiModel::where("user_id", $username)->where("transaction_id", $transaction_id)->get());

        $totalsemua1 = 0;
        for($i = 0; $i<$maks; $i++){
            $totalsemua1 = $totalsemua1 + $a[$i];
        }
        $totalsemua = number_format($totalsemua1,0,',','.');
        return view ('customer/semuapembeliandetail',compact('data','user','totalsemua','status'));
    }

    public function uploadfoto($username,Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
            $tgl=date('Y-m-d');
            $user = $username;
            $red = redirect('/upload_bukti/'.$user.'/'.$id);
        
        return $red;
    }

    public function hapusbeli($username, Request $request, $id)
    {
        $user = $username;
        if(TransaksiModel::where("id",$id)->delete()){
            return back()->with('success', 'Pembelian berhasil dibatalkan!');
        }else{
            return back()->with('danger', 'Pembelian gagal dibatalkan!');
        }
    }

    public function lihatkeranjang($username)
    {
        $user = $username;
        $data = DB::table('barang_models')->join('transaksi_models','barang_models.id_barang','=','transaksi_models.barang_id')->where("keranjang", "Yes")->where('user_id',$user)->where('status',"Keranjang")->get();
        $total = TransaksiModel::where("user_id", $user)->where("keranjang", "Yes")->orderBy('created_at','desc')->get();
        $customer = CustomerModel::where('user_id',$username)->orderBy('created_at','asc')->first();

        foreach ($total as $hargaxx) {
        $a[] = (int)$this->convert_to_angka($hargaxx->harga);
        }
        foreach ($total as $xx) {
        $b[] = $xx->jumlah_dibeli;
        }

        $maks = count(TransaksiModel::where("user_id", $user)->where("keranjang", "Yes")->where('status',"Keranjang")->get());
        $totalsemua1 = 0;
        for($i = 0; $i<$maks; $i++){
            $jumlah[$i] = $a[$i] * $b[$i];
            $totalsemua1 = $totalsemua1 + $jumlah[$i];
        }
        $totalsemua = number_format($totalsemua1,0,',','.');
        
        return view ('customer/keranjang',compact('data','user','totalsemua','customer'));
    }

    public function tambahkeranjang($username,Request $request, $id)
    {
        date_default_timezone_set('Asia/Jakarta');
            $tgl=date('Y-m-d');
        $user = $username;
        $data = [
            'user_id' => $request->user_id,
            'nama_customer' => "-", 
            'alamat'=> "-",
            'email' => "-",
            'no_hp' => "-",
            'barang_id' => $request->barang_id,
            'harga' => $request->harga, 
            'jumlah_dibeli' => "1",
            'status' => "Keranjang",
            'keranjang' => "Yes",
            'tanggal_beli' => $tgl,
            'transaction_id' => "-",
            'total_harga'=> $request->harga
          ];
         $beli = TransaksiModel::create($data);
         return back()->with('success', 'Berhasil ditambah ke keranjang');

    }

    public function updatekeranjang($username,Request $request)
    {
        $user = $username;
        date_default_timezone_set('Asia/Jakarta');
            $tgl=date('Y-m-d');
        if($request->jumlah_dibeli <= 0){
            return back()->with('danger', 'Jumlah barang harus lebih dari 1');
        }
        $hasil = (int)$this->convert_to_angka($request->harga) * $request->jumlah_dibeli;
        $totalharga = number_format($hasil,0,',','.');

         $data = [
            'jumlah_dibeli' => $request->jumlah_dibeli,
            'total_harga'=> $totalharga
            ];
        $pgw = TransaksiModel::where('id',$request->id)->update($data);
         return back()->with('success', 'Berhasil diubah');

    }

    public function keranjangbeli($username,Request $request, $id)
    {
        $user = $username;
        $data = BarangModel::where("id_barang", $id)->first();
        return view ('customer/keranjangpembelian',compact('data','user'));
    }

    public function lihatrekapkeranjang($username)
    {
        $user = $username;
        $data = DB::table('barang_models')->join('transaksi_models','barang_models.id_barang','=','transaksi_models.barang_id')->where("keranjang", "Yes")->where("status", "Keranjang")->where('user_id',$user)->get();
        $total = TransaksiModel::where("user_id", $user)->where("keranjang", "Yes")->orderBy('created_at','desc')->get();
        $customer = TransaksiModel::where('user_id',$username)->orderBy('created_at','desc')->first();
        
        foreach ($total as $hargaxx) {
        $a[] = $this->convert_to_angka($hargaxx->harga);
        }
        foreach ($total as $xx) {
        $b[] = $xx->jumlah_dibeli;
        }

        $maks = count(TransaksiModel::where("user_id", $user)->where("keranjang", "Yes")->where("status", "Keranjang")->get());
        $totalsemua1 = 0;
        for($i = 0; $i<$maks; $i++){
            $jumlah[$i] = $a[$i] * $b[$i];
            $totalsemua1 = $totalsemua1 + $jumlah[$i];
        }
        $totalsemua = number_format($totalsemua1,0,',','.');


        return view ('customer/keranjangpembelian',compact('data','user','totalsemua','customer'));
    }

    public function rekapkeranjang($username, Request $request)
    {
        $user = $username;
        $data_id = TransaksiModel::where("user_id", $user)->where("keranjang", "Yes")->orderBy('created_at','asc')->get();
        foreach ($data_id as $ambil) {
            $id[] = $ambil->id;
        }

        $maks = count($id);
        
        for ($i=0; $i <$maks ; $i++) { 
            
        $ubahdata = [
            'nama_customer' => $request->nama_customer, 
            'alamat'=> $request->alamat,
            'email' => $request->email,
            'no_hp' => $request->no_hp
            ];
        $pgw = TransaksiModel::where('id',$id[$i])->update($ubahdata);
        }
        return redirect('/lihatrekapkeranjang/'.$user)->with('success', 'Transaksi disimpan, Silahkan cek barang yang dibeli beserta identitas penerima');
        
    }

    public function hapuskeranjang($username, Request $request, $id)
    {
        $user = $username;
        
        if(TransaksiModel::where("id",$id)->delete()){
            return back()->with('success', 'Pembelian berhasil dibatalkan!');
        }else{
            return back()->with('danger', 'Pembelian gagal dibatalkan!');
        }
    }

    public function uploadkeranjang($username)
    {
        $user = $username;
        
        $data_user = DB::table('users')
                     ->select(DB::raw('id as id'))
                     ->where('username', $username)
                     ->first();
        $total = TransaksiModel::where("user_id", $user)->where("keranjang", "Yes")->orderBy('created_at','desc')->get();
        foreach ($total as $hargaxx) {
        $a[] = $this->convert_to_angka($hargaxx->harga);
        } 
        foreach ($total as $xx) {
        $b[] = $xx->jumlah_dibeli;
        }

        $maks = count(TransaksiModel::where("user_id", $user)->where("keranjang", "Yes")->get());
        $totalsemua1 = 0;
        for($i = 0; $i<$maks; $i++){
            $jumlah[$i] = $a[$i] * $b[$i];
            $totalsemua1 = $totalsemua1 + $jumlah[$i];
        }
        $totalsemua = number_format($totalsemua1,0,',','.');
        $id_user = $data_user->id; 
        date_default_timezone_set('Asia/Jakarta');
            $tahun=date('Y');
            $bulan=date('m');
            $hari=date('d');
            $jam=date('H');
            $menit=date('i');
            $detik=date('s');
        $id_transaksi = $tahun ."". $bulan ."". $hari ."".$jam ."". $menit ."".$detik ."".$id_user;
        $data_id = TransaksiModel::where("user_id", $username)->where("keranjang", "Yes")->orderBy('created_at','asc')->get();
        foreach ($data_id as $ambil) {
            $id[] = $ambil->id;
        }
        $maks = count($id);
        for ($i=0; $i <$maks ; $i++) { 
        $ubahdata = [
            'transaction_id' => $id_transaksi, 
            'status' => "Menunggu Pembayaran",
            'keranjang' => "No"
            ];
        $pgw = TransaksiModel::where('id',$id[$i])->update($ubahdata);
        }
        $data_transaksi = [
            'user_id'=>$user,
            'id_transaction' => $id_transaksi,
            'status' => "Menunggu Pembayaran",
            'total_harga'=> $totalsemua,
            'bukti_bayar'=> "-"
        ];
        $trans = NomorTransaksiModel::create($data_transaksi);
        
        $data = DB::table('transaksi_models')
                     ->select(DB::raw('SUM(jumlah_dibeli) as jml'))
                     ->where('user_id', $username)
                     ->where('keranjang', "No")
                     ->where('transaction_id', $id_transaksi)
                     ->get();
        return view ('customer/uploadkeranjang',compact('data','user','totalsemua'));
    }

    public function upload($username,Request $request)
    {
        $user = $username;
        date_default_timezone_set('Asia/Jakarta');
            $tgl=date('Y-m-d');
        $validator = $this->validate($request,[
            'bukti_bayar' => 'file|image|mimes:jpeg,png,gif,webp|max:2048',
        ],[
        ]); 
        $data = TransaksiModel::where("user_id", $user)->where("keranjang", "Yes")->orderBy('created_at','asc')->get();
        foreach ($data as $id_transaksi) {
        $x[] = $id_transaksi->id;
        }
        $maks = count(TransaksiModel::where("user_id", $user)->where("keranjang", "Yes")->get());
        $foto = $request->bukti_bayar;
        $bukti_bayar = $foto->getClientOriginalName();
        $foto->move('buktibayar', $bukti_bayar);
        
        for($i = 0; $i<$maks; $i++){
            
            $datax = [
                'bukti_bayar' => $bukti_bayar,
                'keranjang' => "No",
                'status'=> "Menunggu verifikasi"
                ];
            $xx = TransaksiModel::where('id',$x[$i])->where('user_id', $username)->update($datax);
        }
        return redirect('/situs_online/'.$user)->with('success', 'Transaksi berhasil, menunggu verifikasi dari admin');
    }

    function convert_to_rupiah($angka){
        $hasil_rupiah = number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
    function convert_to_angka($nominal){
        $angka = str_replace(".", "", $nominal);
        return $angka;
    }
}
