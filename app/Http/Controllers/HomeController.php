<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::take(4)->orderBy('id','desc')->get();
        return view('home.index',compact('products'));
        
    }
}