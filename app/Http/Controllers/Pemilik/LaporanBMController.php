<?php

namespace App\Http\Controllers\Pemilik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LaporanBMModel;
use App\TransaksiModel;
use Illuminate\Support\Facades\DB;

class LaporanBMController extends Controller
{
    
    public function lihatpengiriman()
    {
        $data = LaporanBMModel::orderBy('created_at','asc')->get();
        return view ('pemilik/laporan_pengiriman',compact('data'));
    }

    public function tambahpengiriman(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
             $tgl=date('Y-m-d');
        $data = [
            'jumlah_barang_masuk'=> $request->jumlah_barang_masuk,
            'tanggal_masuk' => $tgl,
            'status' => "Belum diverifikasi",
            
         ];
        $brg = LaporanBMModel::create($data);
        if($brg){
            $red = redirect('/kirimbarang/')->with('success', 'Data berhasil ditambahkan!');
        } 
        return $red;
    }

    public function hapuspengiriman(Request $request)
    {
        if(LaporanBMModel::where("id",$request->id)->delete()){
            return back()->with('success', 'Data berhasil di hapus!');
        }else{
            return back()->with('danger', 'Data gagal dihapus!');
        }
    }

    public function verifikasipengiriman(Request $request)
    {
        LaporanBMModel::where('id',$request->id)->update([
            "status" => "Terverifikasi"
        ]);
        return redirect('/verifikasi_brg_masuk/')->with('success', 'Data berhasil diverfikasi!');
    }

    public function tampilver()
    {
        $data = LaporanBMModel::orderBy('created_at','asc')->get();
        return view ('pegawai/barang_masuk',compact('data'));
    }

    public function lihatbulanan()
    {
        $data = DB::select('select distinct tanggal_beli from transaksi_models where status = "Terverifikasi" order by tanggal_beli asc');
        
        foreach ($data as $tanggal ) {
        $bulan_tahun[] = substr($tanggal->tanggal_beli, 0,7); 
        }

        $data_tanggal = array_unique($bulan_tahun);
        
        return view ('pemilik/tanggal',compact('data_tanggal'));
    }

    public function pilih_tanggal(Request $request)
    {
        $tanggal = $request->tanggal;
        return redirect('/bulanan/'.$tanggal);
    }

    public function bulanan($tanggal)
    {
        $data = DB::table('barang_models')->join('transaksi_models','barang_models.id_barang','=','transaksi_models.barang_id')->where("status","Terverifikasi ")->where('tanggal_beli','like','%'.$tanggal.'%')->get();
        $total = DB::table('transaksi_models')
                     ->select(DB::raw('SUM(harga) as total'))
                     ->where('status', "Terverifikasi")
                     ->where('tanggal_beli','like','%'.$tanggal.'%')
                     ->get();
        $totalx = DB::table('transaksi_models')
                     ->select(DB::raw('SUM(jumlah_dibeli) as total'))
                     ->where('status', "Terverifikasi")
                     ->where('tanggal_beli','like','%'.$tanggal.'%')
                     ->get();
        return view ('pemilik/penghasilan_per_bulan',compact('data','total','totalx','tanggal'));
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
