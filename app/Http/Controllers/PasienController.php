<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\md_pasien;

use Illuminate\Http\Request;

class PasienController extends Controller
{
    
    public function index()
    {
        $pasien = DB::table('md_pasiens')->orderBy('created_at','asc')->paginate(9);
        return view('data_pasien/index', compact('pasien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('data_pasien/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(Request $request)
        {
            $validator = $this->validate($request,[
                    'nomorRM' => 'required|unique:md_pasiens,nomorRM',
                    'nama' => 'required',
                    'umur' => 'required|numeric|alpha_num',
                    'alamat' => 'required',
                ],[
                    'nomorRM.required' => "Nomor RM tidak boleh kosong",
                    'nomorRM.unique' => "Nomor RM sudah ada",
                    'umur.numeric' => "Umur harus berupa angka",
                    'umur.alpha_num' => "Umur harus lebih dari 0",
                    'umur.required' => "Umur tidak boleh kosong",
                    'nama.required' => "Nama tidak boleh kosong",
                    'alamat.required' => "Alamat tidak boleh kosong",
                    
                ]);
            $data = [
                'nomorRM' => $request->nomorRM,
                'nama' => $request->nama,
                'umur' => $request->umur,
                'alamat' => $request->alamat,
                'kelamin' => $request->kelamin,
                ];
                $dtpasiens = md_pasien::create($data);
            if($dtpasiens){
                $red = redirect('/data_pasien')->with('success', 'Data pasien berhasil ditambahkan!');
            } else {
                $red = redirect('/data_pasien')->with('danger', 'Data pasien gagal ditambahkan!');
            }
            return $red;
        }
        
        
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dtpasiens = md_pasien::where("nomorRM",$id)->first();
        return view('data_pasien/d_pasien', ['dtpasien'=> $dtpasiens]);
    }

    public function find()
    {
        return view('data_pasien/cari');
    }

    public function cari(Request $request)
    {
        $search = $request->get('search');
        $pasien = DB::table('md_pasiens')->where('nama','like','%'.$search.'%')->paginate(9);
        return view('data_pasien/index', ['pasien'=> $pasien]);
    }


    public function search (Request $request)
    {
        $search = $request->search;
        $dtpasien = DB::table('md_pasiens')->where('nomorRM',$search)->first();
        if ($dtpasien){ 
        return view('data_pasien/d_pasien', compact('dtpasien'));
    }  else {
        return redirect('/halamancari')->with('danger', 'Data pasien tidak ditemukan!');
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dtpasien = md_pasien::where("nomorRM",$id)->first();
        $pasien_id = $id;
        return view('data_pasien/edit', compact('dtpasien','pasien_id'));
    }

    /** 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = $this->validate($request,[
            'nama' => 'required',
            'umur' => 'required|numeric|alpha_num',
            'alamat' => 'required',
            
        ],[
            'umur.numeric' => "Umur harus berupa angka",
            'umur.alpha_num' => "Umur harus lebih dari 0",
            'umur.required' => "Umur tidak boleh kosong",
            'nama.required' => "Nama tidak boleh kosong",
            'alamat.required' => "Alamat tidak boleh kosong",
            
        ]);
        $data = [
                'nomorRM' => $request->nomorRM,
                'nama' => $request->nama,
                'umur' => $request->umur,
                'alamat' => $request->alamat,
                'kelamin' => $request->kelamin,
                ];
        $dtpasiens = md_pasien::where('nomorRM',$request->nomorRM)->update($data);
        if(!$dtpasiens){
            $red = redirect('/data_pasien')->with('danger', 'Data pasien gagal diubah!');
            
        } else {
            $red = redirect('/data_pasien')->with('success', 'Data pasien berhasil diubah!');
        }
        return $red; 
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        if(md_pasien::where("nomorRM",$request->nomorRM)->delete()){
            return back()->with('success', 'Data Pasien berhasil di hapus!');
        }else{
            return back()->with('danger', 'Data Pasien gagal dihapus!');
        }
    }
}
