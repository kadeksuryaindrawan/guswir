<?php

namespace App\Http\Controllers;

use Auth;
use App\Ulasan;
use Illuminate\Http\Request;
use App\Product;

class UlasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $product = Product::where('id',$id)->first();
        return view('ulasan.index',compact(['product']));
    }

    public function ulasan(Request $request){
        $this->validate(request(),[
            'ulasan'=>'required',
            'image'=>'required|image',
            'comment'=>'required',
        ]);

        $product_id = $request->id;
        $imagepath = $request->image->store('ulasan','public');

        $ulasan = new Ulasan();
        $ulasan->product_id = $product_id; 
        $ulasan->ulasan = $request->input('ulasan');
        $ulasan->image=$imagepath;
        $ulasan->comment = $request->input('comment');
        Auth::user()->ulasan()->save($ulasan);

        return redirect()->route('order.show')->with('success','Sukses memberi ulasan!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
}
