<?php

namespace App\Http\Controllers\Pemilik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    
    public function lihatpegawai()
    {
        $data = User::where('pekerjaan','pegawai')->get();
        return view('pemilik/pegawai', compact('data'));
    }

    public function tambahpegawai(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
            $tgl=date('Y-m-d');
        $validator = $this->validate($request,[
                'username' => 'required|unique:users,username',
                'nama' => 'required'
            ],[
                'username.required' => "Username tidak boleh kosong",
                'username.unique' => "Username sudah ada",
                'nama.required' => "Nama tidak boleh kosong"
            ]);
        User::create([
            'nama' => $request['nama'],
            'username' => $request['username'],
            'pekerjaan' => "pegawai",
            'password' => bcrypt($request['password']),
        ]);
        return redirect('/akun_pegawai')->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    public function ubahpegawai(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
            $tgl=date('Y-m-d');
        $data = [
            'id' => $request->id,
            'username'=> $request->username,
            'nama' => $request->nama,
            'password' => $request->password,
            'pekerjaan' => "pegawai",
         ];
         $pgw = User::where('id',$request->id)->update($data);
         if($pgw){
            $red = redirect('/akun_pegawai/')->with('success', 'Data pegawai berhasil diubah!');
        } 
        return $red;
    }

    public function hapuspegawai(Request $request)
    {
        if(User::where("id",$request->id)->delete()){
            return back()->with('success', 'Data Pegawai berhasil di hapus!');
        }else{
            return back()->with('danger', 'Data Pegawai gagal dihapus!');
        }
    
    }

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
