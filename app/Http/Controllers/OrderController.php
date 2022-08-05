<?php

namespace App\Http\Controllers;
use App\Order;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(){
        $orders = Auth::user()->orders;
        $orders->transform(function($order,$key){
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('orders.index',compact(['orders']));
    }

    public function uploadBukti($id){
        $order = Order::where('id',$id)->first();
        return view('orders.upload',compact(['order']));
    } 
    
    public function uploadBuktiProcess(Request $request){
        $this->validate(request(),[
            'bukti_bayar'=>'required|image',
        ]);

        $id = $request->id;

        $imagepath = $request->bukti_bayar->store('buktiBayar','public');

        $order = Order::findOrFail($id);
            
        $order->bukti_bayar=$imagepath;
        $order->status = 'sudah bayar';
        $order->save();

        return redirect()->route('order.show')->with('success','Sukses upload bukti');
    } 
}