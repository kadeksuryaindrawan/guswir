<?php

namespace App\Http\Controllers;
use App\Order;
use App\User;
use App\Profile;
use App\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $totalgross = 0;

        $users = User:: get();
        $totaluser = count($users);

        $orders = Order::get();
        $totalorder = count($orders);
     
        
        
        if(Reminder::find(1)==null)
        {
            $reminder=new Reminder();
            $reminder->id = 1;
            $reminder->reminder="Type something";
            $reminder->save();
            $reminder = Reminder::find(1);
        }
        else
        {
            $reminder = Reminder::find(1);
        }
        
        $gross = Order::get();
        $gross->transform(function($order,$key){
            $order->cart = unserialize($order->cart);
            return $order;
        });

        foreach ($gross as $x){
           $totalgross+= $x->cart->totalPrice;
        }


        $latest=Order::orderBy('created_at','DESC')->take(5)->get();
        
        return view('admin.index',compact('latest','totaluser','totalorder','totalgross','reminder'));
    }

    public function order()
    {
        $orders=Order::where('status','selesai')->orderBy('created_at','DESC')->get();
        
        return view('admin.order',compact('orders'));
    }

    public function orderAcc($id)
    {
        
        $order = Order::findOrFail($id);
        $email = $order->user->email;
        $name = $order->user->name;
        $status = 'Pesanan Berhasil';
        $article = [
            'name'=>$name,
            'id' => $id,
            'body' =>'
    Pesanan kamu dengan orderID '.$id.' telah dikonfirmasi oleh Admin Toko Komang Martini.

    Pesanan kamu telah selesai. Terima kasih sudah belanja di Toko Komang Martini.',
        ];
        $order->status='selesai';
        $order->save();
        Mail::to($email)->send(new UserNotification($article,$status));
        $orders=Order::where('status','selesai')->orderBy('created_at','DESC')->get();
        return view('admin.order',compact('orders'));
    }

    public function orderDel($id)
    {
        
        $order = Order::findOrFail($id);
        $bukti_path = public_path().'/storage/'.$order->bukti_bayar;
        unlink($bukti_path);
        $email = $order->user->email;
        $name = $order->user->name;
        $status = 'Pesanan Gagal';
        $article = [
            'name'=>$name,
            'id' => $id,
            'body' =>'
    Pesanan kamu dengan orderID '.$id.' telah ditolak oleh Admin Toko Komang Martini.

    Pesanan kamu belum selesai. Silahkan upload ulang bukti pembayaran.',
        ];
        $order->status='belum bayar';
        $order->bukti_bayar=NULL;
        $order->save();
        Mail::to($email)->send(new UserNotification($article,$status));
        $orders=Order::where('status','sudah bayar')->orWhere('status','belum bayar')->orderBy('created_at','DESC')->get();
        return view('admin.order',compact('orders'));
    }

    public function orderBaru()
    {
        $orders=Order::where('status','sudah bayar')->orWhere('status','belum bayar')->orderBy('created_at','DESC')->get();
        
        return view('admin.order',compact('orders'));
    }

    public function laporan()
    {
        $orders=Order::orderBy('created_at','DESC')->get();
        
        return view('admin.order',compact('orders'));
    }

    public function show_order($id)
    {
        $ids =DB::table('orders')->where('id',$id)->get();

        $order =DB::table('orders')->where('id',$id)->get();
        $order->transform(function($order,$key){
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('admin.showorder',compact('order','ids'));
    }

    public function user()
    {
        $users=DB::table('users')->leftjoin('profiles','users.id','=','profiles.user_id')->where('users.role','Customer')->get();
        return view('admin.user',compact('users'));
    }

    public function updatereminder()
    {
        $reminder= Reminder::find(1);
        $reminder->reminder = request('reminder');
        $reminder->save();

        return redirect()->route('admin.index')->with('success','Successfully updated the reminder!');
    }


}