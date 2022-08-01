<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Cart;
use App\Order;
use App\Profile;
use App\Product;
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
        ]);
        
        if(!Session::has('cart')){
            return view('cart.index');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        foreach ($cart->items as $order) {
            Product::where('id',$order['product_id'])
                    ->decrement('quantity');
        }
        

        $order = new Order();
        $order->cart = serialize($cart); 
        $order->address = $request->input('address');
        $order->name = $request->input('name');
        $order->phonenumber = $request->input('phonenumber');
        $order->status = 'sudah bayar';
        $order->city = $request->input('city');

        $profile = new Profile();
        $profile->address = $request->input('address');
        $profile->phonenumber = $request->input('phonenumber');
        $profile->city = $request->input('city');
        
        Auth::user()->orders()->save($order);

        Session::forget('cart');
        return redirect()->route('home.index')->with('success','Successfully purchased the products!');
    }
}