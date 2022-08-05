<?php

namespace App\Http\Controllers;
use App;
use App\Product;
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
            $product = Product::find($id);
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($product,$qty);
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
            return view('cart.index',['products'=>null]);
        }
        $oldCart= Session::get('cart');
        $cart= new Cart($oldCart);
        $products = $cart->items;
        $totalPrice = $cart->totalPrice;
        $totalQuantity= $cart->totalQuantity;
        return view('cart.index', compact ('products','totalPrice','totalQuantity'));
    }
}