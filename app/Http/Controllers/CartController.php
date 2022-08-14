<?php

namespace App\Http\Controllers;
use App;
use App\Produk;
use App\Cart;
use Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $this->validate(request(),[
            'qty'=>'required|integer',
        ]);
        $qty = $request->qty;
        if($qty>0 && $qty<=3){
            $produk = Produk::find($id);
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($produk,$qty);
            $request->session()->put('cart',$cart);
            return redirect()->route('cart.index');
        }
        else{
            return redirect()->back();
        }
        
    }

    public function remove($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($id);
    
        Session::put('cart',$cart);
        if($cart->totalQuantity<=0){
            Session::forget('cart');
        }
        return redirect()->route('cart.index');
    }

    public function index()
    {
        if(!Session::has('cart')){
            return view('cart.index',['produks'=>null]);
        }
        $oldCart= Session::get('cart');
        $cart= new Cart($oldCart);
        $produks = $cart->items;
        $totalPrice = $cart->totalPrice;
        $totalQuantity= $cart->totalQuantity;
        return view('cart.index', compact ('produks','totalPrice','totalQuantity'));
    }
}