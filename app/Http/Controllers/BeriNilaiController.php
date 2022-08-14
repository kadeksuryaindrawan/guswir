<?php

namespace App\Http\Controllers;

use Auth;
use App\BeriNilai;
use Illuminate\Http\Request;
use App\produk;

class BeriNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $produk = Produk::where('id',$id)->first();
        return view('berinilai.index',compact(['produk']));
    }

    public function ulasan(Request $request){
        $this->validate(request(),[
            'ulasan'=>'required',
            'image'=>'required|image',
            'comment'=>'required',
        ]);

        $produk_id = $request->id;
        $imagepath = $request->image->store('ulasan','public');

        $ulasan = new BeriNilai();
        $ulasan->produk_id = $produk_id; 
        $ulasan->ulasan = $request->input('ulasan');
        $ulasan->image=$imagepath;
        $ulasan->comment = $request->input('comment');
        Auth::user()->berinilai()->save($ulasan);

        return redirect()->route('pembelian.show')->with('success','Sukses memberi ulasan!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
}
