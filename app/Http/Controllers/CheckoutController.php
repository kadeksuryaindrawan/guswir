<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Cart;
use App\Pembelian;
use App\Produk;
use DB;

class CheckoutController extends Controller
{
    public function index()
    {
        if(!Session::has('cart')){
            return view('cart.index');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        $user = Auth::user();
        return view('checkout.index',compact('total','user'));
    }

    public function checkout(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required|string',
            'phonenumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'city' => 'required|string',
            'address' => 'required',
            'ongkir' => 'required',
        ]);
        
        if(!Session::has('cart')){
            return view('cart.index');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        foreach ($cart->items as $pembelian) {
            $produk = Produk::where('id',$pembelian['produk_id'])->first();
            $produk->quantity = $produk->quantity - $pembelian['quantity'];
            $produk->save();
        }
        

        $pembelian = new Pembelian();
        $pembelian->cart = serialize($cart); 
        $pembelian->address = $request->input('address');
        $pembelian->name = $request->input('name');
        $pembelian->phonenumber = $request->input('phonenumber');
        $pembelian->status = 'belum bayar';
        $pembelian->ongkir = $request->input('ongkir');
        $pembelian->bukti_bayar = NULL;
        $pembelian->city = $request->input('city');
        
        Auth::user()->pembelians()->save($pembelian);

        Session::forget('cart');
        return redirect()->route('home.index')->with('success','Successfully purchased the produks!');
    }

    public function city(Request $request)
    {
        $city = $request->city;
        if($city == 'Denpasar'){
            return '<option value="16000">Rp. 16.000</option>';
        }
        if($city == 'Jembrana'){
            return '<option value="17000">Rp. 17.000</option>';
        }
        if($city == 'Tabanan'){
            return '<option value="15000">Rp. 15.000</option>';
        }
        if($city == 'Badung'){
            return '<option value="13000">Rp. 13.000</option>';
        }
        if($city == 'Bangli'){
            return '<option value="14000">Rp. 14.000</option>';
        }
        if($city == 'Buleleng'){
            return '<option value="19000">Rp. 19.000</option>';
        }
        if($city == 'Gianyar'){
            return '<option value="15000">Rp. 15.000</option>';
        }
        if($city == 'Klungkung'){
            return '<option value="10000">Rp. 10.000</option>';
        }
        if($city == 'Karangasem'){
            return '<option value="19500">Rp. 19.500</option>';
        }
    }
    
}