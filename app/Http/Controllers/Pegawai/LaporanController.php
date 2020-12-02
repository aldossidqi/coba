<?php

namespace App\Http\Controllers\Pegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LaporanModel;
use App\BarangModel;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
   
    public function lihatlaporan()
    {
        $data = LaporanModel::orderBy('created_at','asc')->get();
        $data1 = LaporanModel::orderBy('created_at','desc')->first();
        return view ('pegawai/laporan',compact('data','data1'));
    }

    public function tambahlaporan(Request $request)
    {
        $hasil =0;
        date_default_timezone_set('Asia/Jakarta');
             $tgl=date('Y-m-d');
        
        $barang = BarangModel::where('id_barang', $request->id_barang)->first();
        if(!$barang){
            return redirect('/laporan_pegawai/')->with('danger', 'Data barang dengan ID tersebut tidak ditemukan!');
        } else {
        $hasil = $barang->jumlah_barang - $request->jumlah_barang_terjual;
        if ($hasil < 0){
            return redirect('/laporan_pegawai/')->with('danger', 'Data yang diinputkan salah, stok barang tidak mencukupi!');
        } else {
        $data = [
            'id_barang'=> $request->id_barang,
            'jumlah_barang_terjual' => $request->jumlah_barang_terjual,
            'jumlah_uang_masuk' => $request->jumlah_uang_masuk,
            'tanggal' => $tgl,
         ];
        $brg = LaporanModel::create($data);
        BarangModel::where('id_barang',$request->id_barang)->update([
            "jumlah_barang" => $hasil,
        ]);
        if($brg){
            $red = redirect('/laporan_pegawai/')->with('success', 'Laporan berhasil ditambahkan!');
        } 
        return $red;
        }
    }
    }

    public function hapuslaporan(Request $request)
    {
        $barang = BarangModel::where('id_barang', $request->id_barang)->first();
        $hasil = $barang->jumlah_barang + $request->jumlah_barang_terjual;
        BarangModel::where('id_barang',$request->id_barang)->update([
            "jumlah_barang" => $hasil,
        ]);
        if(LaporanModel::where("id",$request->id)->delete()){
            return back()->with('success', 'Barang berhasil di hapus!');
        }else{
            return back()->with('danger', 'Barang gagal dihapus!');
        }
    }

    public function pemilikliat(Request $request)
    {
        //$data = LaporanModel::orderBy('created_at','asc')->get();
        $data = DB::table('barang_models')->join('laporan_models','barang_models.id_barang','=','laporan_models.id_barang')->get();
        $total = DB::select('select SUM(jumlah_uang_masuk) as total from laporan_models');
        return view ('pemilik/laporan_toko',compact('data','total'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
