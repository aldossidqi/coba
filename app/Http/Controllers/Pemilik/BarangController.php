<?php

namespace App\Http\Controllers\Pemilik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\BarangModel;
use App\TransaksiModel;
use App\NomorTransaksiModel;


class BarangController extends Controller
{
    
    public function lihatbarang()
    {
        $data = BarangModel::orderBy('created_at','asc')->get();
        return view ('pemilik/barang',compact('data'));

    }

    public function tambahbarang(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
             $tgl=date('Y-m-d');
        
        $validator = $this->validate($request,[
                'id_barang' => 'required|unique:barang_models,id_barang',
                'gambar' => 'file|image|mimes:jpeg,png,gif,webp|max:2048'
            ],[
                'id_barang.required' => "ID Barang tidak boleh kosong",
                'id_barang.unique' => "ID Barang sudah ada"
            ]);
        $foto = $request->gambar;
        $gambar = $foto->getClientOriginalName();
        $foto->move('gambarbrg', $gambar); 
        $data = [
            'id_barang'=> $request->id_barang,
            'gambar' => $gambar,
            'jumlah_barang' => $request->jumlah_barang,
            'jenis' => $request->jenis,
            'harga' => $request->harga,
            'warna' => $request->warna,
            'total_dilihat' => 0,
         ];
        $brg = BarangModel::create($data);
        if($brg){
            $red = redirect('/barang/')->with('success', 'Data barang berhasil ditambahkan!');
        } 
        return $red;
    }

    public function ubahbarang(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
             $tgl=date('Y-m-d');
        if($request->gambar){  
        $foto = $request->gambar;
        $gambar = $foto->getClientOriginalName();
        $foto->move('gambarbrg', $gambar);
        $data = [
            'id_barang'=> $request->id_barang,
            'gambar' => $gambar,
            'jumlah_barang' => $request->jumlah_barang,
            'jenis' => $request->jenis,
            'harga' => $request->harga,
            'warna' => $request->warna,
            'total_dilihat' => 0,
         ];
         } else {
            $data = [
            'id_barang'=> $request->id_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'jenis' => $request->jenis,
            'harga' => $request->harga,
            'warna' => $request->warna,
            'total_dilihat' => $request->total_dilihat,
         ];
         }
        $brg = BarangModel::where('id_barang',$request->id_barang)->update($data);
        if($brg){
            $red = redirect('/barang/')->with('success', 'Data barang berhasil diubah!');
        } 
        return $red;
    }

    public function hapusbarang(Request $request)
    {
        if(BarangModel::where("id_barang",$request->id_barang)->delete()){
            return back()->with('success', 'Barang berhasil di hapus!');
        }else{
            return back()->with('danger', 'Barang gagal dihapus!');
        }
    }

    public function lihataja()
    {
        $data = BarangModel::orderBy('created_at','asc')->get();
        return view ('pegawai/barang',compact('data'));
    }

    public function situsonline()
    {
        $data = BarangModel::orderBy('created_at','asc')->get();
        return view ('online',compact('data'));
    }

    public function verifikasibeli()
    {
        $data = NomorTransaksiModel::where("status","Menunggu verifikasi ")->orderBy('created_at','asc')->get();
        return view ('pemilik/verifikasi_pembelian',compact('data')); 
    }

    public function verifikasibarang(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
            $tgl=date('Y-m-d');
        $transaksi = TransaksiModel::where('transaction_id', $request->id_transaction)->get();
        $transaksi_total = count(TransaksiModel::where('transaction_id', $request->id_transaction)->get());

        foreach ($transaksi as $key ) {
            $idBarang[] = $key->barang_id;
            $transJmlBrg[] = $key->jumlah_dibeli;
        }

        for ($i=0; $i < $transaksi_total; $i++) { 
            $barang = BarangModel::where('id_barang', $idBarang[$i])->get();
            foreach ($barang as $barang ) {
                $jmlBarang[] = $barang->jumlah_barang;
            }
            $total[$i] = $jmlBarang[$i] - $transJmlBrg[$i];
            $data1 = [
                'jumlah_barang' => $total[$i],
            ];

            $brg = BarangModel::where('id_barang',$idBarang[$i])->update($data1);
        }

        $update_transaksi = [
            'status' => "Terverifikasi",
            ];
        $cstmr = TransaksiModel::where('transaction_id',$request->id_transaction)->update($update_transaksi);

        $update_no_trans = [
            'status' => "Terverifikasi",
            ];
        $cstmr = NomorTransaksiModel::where('id_transaction',$request->id_transaction)->update($update_no_trans);

        return redirect('/verifikasi_pembelian')->with('success', 'Berhasil diverifikasi!');
    }

    public function detailbarang($id)
    {
        $data = BarangModel::where("id_barang", $id)->first();
        return view ('pemilik/detailbarang',compact('data'));
    }

    public function baranglaku()
    {
        $data = DB::table('barang_models')->join('transaksi_models','barang_models.id_barang','=','transaksi_models.barang_id')->where("status","Terverifikasi ")->get();
        $total = DB::table('transaksi_models')
                     ->select(DB::raw('SUM(harga) as total'))
                     ->where('status', "Terverifikasi")
                     ->get();
        $totalx = DB::table('transaksi_models')
                     ->select(DB::raw('SUM(jumlah_dibeli) as total'))
                     ->where('status', "Terverifikasi")
                     ->get();
        

        return view ('pemilik/barang_laku',compact('data','total','totalx','ft'));
    }
}
