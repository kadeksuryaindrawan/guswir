<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $produks = Produk::take(4)->where('quantity','!=',0)->orderBy('id','desc')->get();
        return view('home.index',compact('produks'));
        
    }
}