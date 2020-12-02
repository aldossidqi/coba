<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\md_obat;
use App\md_pasien;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use PDF;

class ObatController extends Controller
{
    public function lihatresep($id)
    { 
        $dtpasien = md_pasien::where("nomorRM",$id)->first();
        $resep = md_obat::where('dtpasien_id',$id)->orderBy('tanggal_pemakaian','asc')->get();
        $database = DB::select('select distinct tanggal_pemakaian from md_obats where dtpasien_id = ? order by tanggal_pemakaian asc', [$id]);
        
        $temp = 0;
        $index = 0;
        $ft = array();
        for($i=0; $i<count($database); $i++){
            if($temp != $database[$i]->tanggal_pemakaian){
                $ft[$index] = $database[$i]->tanggal_pemakaian;
                $index++;
            }
            $temp = $database[$i];
        }
        $pasien_id = $id;

        return view ('pendataan_obat/lihat_obat',compact('resep','pasien_id','dtpasien','ft'));
    }
    
    public function tanggal ($id, Request $request){
        $cari = $request->tanggal;
        $dtpasien = md_pasien::where("nomorRM",$id)->first();
        $tanggal = md_obat::where('dtpasien_id',$id)->where('tanggal_pemakaian', $cari)->orderBy('created_at','desc')->get();
        $pasien_id = $id;
        return view ('pendataan_obat/tampil_tanggal',compact('tanggal','pasien_id','dtpasien', 'cari'));
    }

    public function storeresep(Request $request)
    {
        $validator = $this->validate($request,[
                    'nama_obat' => 'required',
                    'dosis' => 'required',
                    'jumlah_obat' => 'required',
                    
                ],[
                    'nama_obat.required' => "Nama Obat tidak boleh kosong",
                    'dosis.required' => "Jumlah Obat tidak boleh kosong",
                    'jumlah_obat.required' => "Aturan pakai tidak boleh kosong"
                ]);
        date_default_timezone_set('Asia/Jakarta');
             $tgl=date('Y-m-d');
        $data = [
            'tanggal_pemakaian' => $tgl,
            'dtpasien_id' => $request->pasien_id,
            'nama_obat' => $request->nama_obat,
            'dosis' => $request->dosis,
            'jumlah_obat' => $request->jumlah_obat,
        ];
        $resep = md_obat::create($data);
        if($resep){
            $red = redirect('/lihat_obat/'.$request->pasien_id)->with('success', 'Obat berhasil ditambahkan!');
        } else {
            $red = redirect('/lihat_obat/'.$request->pasien_id)->with('danger', 'Obat gagal dimasukan!');
        }
        return $red;
    }

    public function simpanresep(Request $request)
    {
         $validator = $this->validate($request,[
                    'tanggal_pemakaian' => 'required',
                    'nama_obat' => 'required',
                    'dosis' => 'required',
                    'jumlah_obat' => 'required'
                ],[
                    'tanggal_pemakaian.required' => "Tanggal tidak boleh kosong",
                    'nama_obat.required' => "Nama Obat tidak boleh kosong",
                    'dosis.required' => "Jumlah Obat tidak boleh kosong",
                    'jumlah_obat.required' => "Aturan pakai tidak boleh kosong"
                ]);
         $data = [
            'id' => $request->id,
            'tanggal_pemakaian' => $request->tanggal_pemakaian,
            'nama_obat' => $request->nama_obat,
            'dosis' => $request->dosis,
            'jumlah_obat' => $request->jumlah_obat
        ];
        $resep =  md_obat::where('id',$request->id)->update($data);
        if($resep){
            return back()->with('success', 'Obat berhasil diubah!');
        } else {
            return back()->with('danger', 'Obat gagal diubah!');
        }
        return $red;
    }

    public function simpanobat(Request $request, $pasien_id, $tanggal)
    {
         $validator = $this->validate($request,[
                    'tanggal_pemakaian' => 'required',
                    'nama_obat' => 'required',
                    'dosis' => 'required',
                    'jumlah_obat' => 'required'
                ],[
                    'tanggal_pemakaian.required' => "Tanggal tidak boleh kosong",
                    'nama_obat.required' => "Nama Obat tidak boleh kosong",
                    'dosis.required' => "Jumlah Obat tidak boleh kosong",
                    'jumlah_obat.required' => "Aturan pakai tidak boleh kosong"
                ]);
         $data = [
            'id' => $request->id,
            'tanggal_pemakaian' => $request->tanggal_pemakaian,
            'nama_obat' => $request->nama_obat,
            'dosis' => $request->dosis,
            'jumlah_obat' => $request->jumlah_obat
        ];
        $resep =  md_obat::where('id',$request->id)->update($data);
        if($resep){
            return $red = redirect('/cari_obat/'.$pasien_id.'/'.$tanggal)->with('success', 'Obat berhasil diubah!');
        } else {
            return $red = redirect('/cari_obat/'.$pasien_id.'/'.$tanggal)->with('success', 'Obat gagal diubah!');
        }
        return $red;
    }

    public function hapusresep(Request $request){
        if(md_obat::where("id",$request->id)->delete()){
            return back()->with('success', 'Obat berhasil dihapus!');
        }else{
            return back()->with('danger', 'Obat gagal dihapus!');
        }
    }

    public function hapusobat(Request $request, $pasien_id, $tanggal){
        if(md_obat::where("id",$request->id)->delete()){
            return $red = redirect('/cari_obat/'.$pasien_id.'/'.$tanggal)->with('success', 'Obat berhasil dihapus!');
        }else{
            return back()->with('danger', 'Obat gagal dihapus!');
        }
    }

    public function cetak(Request $request, $id, $tanggal){
        $cari = $request->tanggal;
        $dtpasien = md_pasien::where("nomorRM",$id)->first();
        $tanggal = md_obat::where('dtpasien_id',$id)->where('tanggal_pemakaian', $cari)->orderBy('created_at','desc')->get();
        $pasien_id = $id;

        $data = [
            'pasien' => $dtpasien,
            'tanggal' => $tanggal,
            'pasien_id' => $pasien_id,
            'cari' => $cari,
        ];
 
        $pdf = PDF::loadview('/pendataan_obat/resep', $data);
        return $pdf->stream();
    }
}
