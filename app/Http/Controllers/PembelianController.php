<?php

namespace App\Http\Controllers;
use App\Pembelian;
use Auth;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function show(){
        $pembelians = Auth::user()->pembelians;
        $pembelians->transform(function($pembelian,$key){
            $pembelian->cart = unserialize($pembelian->cart);
            return $pembelian;
        });
        return view('pembelian.index',compact(['pembelians']));
    }

    public function uploadBukti($id){
        $pembelian = Pembelian::where('id',$id)->first();
        return view('pembelian.upload',compact(['pembelian']));
    } 
    
    public function uploadBuktiProcess(Request $request){
        $this->validate(request(),[
            'bukti_bayar'=>'required|image',
        ]);

        $id = $request->id;

        $imagepath = $request->bukti_bayar->store('buktiBayar','public');

        $pembelian = Pembelian::findOrFail($id);
            
        $pembelian->bukti_bayar=$imagepath;
        $pembelian->status = 'sudah bayar';
        $pembelian->save();

        return redirect()->route('pembelian.show')->with('success','Sukses upload bukti');
    } 
}