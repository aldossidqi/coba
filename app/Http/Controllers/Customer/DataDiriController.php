<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CustomerModel;

class DataDiriController extends Controller
{
    
    public function lihatdatadiri($username)
    {
        $data = CustomerModel::where('user_id',$username)->orderBy('created_at','asc')->first();
        $user = $username;
        return view ('customer/datadiri',compact('data','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ubahdatadiri($username, Request $request)
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
          ];
        $dd = CustomerModel::where('user_id',$username)->update($data);

         if($dd){
            $red = redirect('/datadiri/'.$user)->with('success', 'Berhasil Diubah');
        } 
        return $red;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

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
