<?php

namespace App\Http\Controllers;
use App\User;
use App\Order;
use App\Profile;
use App\Reminder;
use Illuminate\Http\Request;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use PDF;

class AdminController extends Controller
{
    public function index()
    {
        $totalgross = 0;

        $users = User::where('role','Customer')->get();
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
        
        $gross = Order::where('status','selesai')->get();
        $gross->transform(function($order,$key){
            $order->cart = unserialize($order->cart);
            return $order;
        });

        foreach ($gross as $x){
           $totalgross+= $x->cart->totalPrice + $x->ongkir;
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
        return view('admin.laporan');
    }

    public function laporanBulan(Request $request)
    {
        $bulan = $request->bulan;

        if($bulan == '01'){
            $orders = Order::where('status','selesai')->whereMonth('created_at',$bulan)->orderBy('created_at','DESC')->get();
            ?>
                <a href="<?= route('laporan.unduh',['bulan'=>'01']) ?>"><button class="btn btn-primary btn-sm mb-4">Unduh Laporan</button></a></div>
            <?php
            foreach ($orders as $order){
                ?>
                    <a href="<?=route('admin.showorder',['id'=>$order->id])?>" class="list-group-item latest-order">
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="id" style="width:150px">Order ID: <?= $order->id ?></div>
                                <div class="id" style="width:350px">Tanggal Order: <?= date("d-M-Y",strtotime($order->created_at)) ?> </div>
                                <div class="name">Customer Name: <?=$order->name?></div>
                                <div class="status text-primary ml-auto"><?=$order->status?></div> 
                            </div>
                        </div>
                    </a>
                <?php
            };
        }
        if($bulan == '02'){
            $orders = Order::where('status','selesai')->whereMonth('created_at',$bulan)->orderBy('created_at','DESC')->get();
            ?>
                <a href="<?= route('laporan.unduh',['bulan'=>'02']) ?>"><button class="btn btn-primary btn-sm mb-4">Unduh Laporan</button></a></div>
            <?php
            foreach ($orders as $order){
                ?>
                    <a href="<?=route('admin.showorder',['id'=>$order->id])?>" class="list-group-item latest-order">
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="id" style="width:150px">Order ID: <?= $order->id ?></div>
                                <div class="id" style="width:350px">Tanggal Order: <?= date("d-M-Y",strtotime($order->created_at)) ?> </div>
                                <div class="name">Customer Name: <?=$order->name?></div>
                                <div class="status text-primary ml-auto"><?=$order->status?></div> 
                            </div>
                        </div>
                    </a>
                <?php
            };
        }
        if($bulan == '03'){
            $orders = Order::where('status','selesai')->whereMonth('created_at',$bulan)->orderBy('created_at','DESC')->get();
            ?>
                <a href="<?= route('laporan.unduh',['bulan'=>'03']) ?>"><button class="btn btn-primary btn-sm mb-4">Unduh Laporan</button></a></div>
            <?php
            foreach ($orders as $order){
                ?>
                    <a href="<?=route('admin.showorder',['id'=>$order->id])?>" class="list-group-item latest-order">
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="id" style="width:150px">Order ID: <?= $order->id ?></div>
                                <div class="id" style="width:350px">Tanggal Order: <?= date("d-M-Y",strtotime($order->created_at)) ?> </div>
                                <div class="name">Customer Name: <?=$order->name?></div>
                                <div class="status text-primary ml-auto"><?=$order->status?></div> 
                            </div>
                        </div>
                    </a>
                <?php
            };
        }
        if($bulan == '04'){
            $orders = Order::where('status','selesai')->whereMonth('created_at',$bulan)->orderBy('created_at','DESC')->get();
            ?>
                <a href="<?= route('laporan.unduh',['bulan'=>'04']) ?>"><button class="btn btn-primary btn-sm mb-4">Unduh Laporan</button></a></div>
            <?php
            foreach ($orders as $order){
                ?>
                    <a href="<?=route('admin.showorder',['id'=>$order->id])?>" class="list-group-item latest-order">
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="id" style="width:150px">Order ID: <?= $order->id ?></div>
                                <div class="id" style="width:350px">Tanggal Order: <?= date("d-M-Y",strtotime($order->created_at)) ?> </div>
                                <div class="name">Customer Name: <?=$order->name?></div>
                                <div class="status text-primary ml-auto"><?=$order->status?></div> 
                            </div>
                        </div>
                    </a>
                <?php
            };
        }
        if($bulan == '05'){
            $orders = Order::where('status','selesai')->whereMonth('created_at',$bulan)->orderBy('created_at','DESC')->get();
            ?>
                <a href="<?= route('laporan.unduh',['bulan'=>'05']) ?>"><button class="btn btn-primary btn-sm mb-4">Unduh Laporan</button></a></div>
            <?php
            foreach ($orders as $order){
                ?>
                    <a href="<?=route('admin.showorder',['id'=>$order->id])?>" class="list-group-item latest-order">
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="id" style="width:150px">Order ID: <?= $order->id ?></div>
                                <div class="id" style="width:350px">Tanggal Order: <?= date("d-M-Y",strtotime($order->created_at)) ?> </div>
                                <div class="name">Customer Name: <?=$order->name?></div>
                                <div class="status text-primary ml-auto"><?=$order->status?></div> 
                            </div>
                        </div>
                    </a>
                <?php
            };
        }
        if($bulan == '06'){
            $orders = Order::where('status','selesai')->whereMonth('created_at',$bulan)->orderBy('created_at','DESC')->get();
            ?>
                <a href="<?= route('laporan.unduh',['bulan'=>'06']) ?>"><button class="btn btn-primary btn-sm mb-4">Unduh Laporan</button></a></div>
            <?php
            foreach ($orders as $order){
                ?>
                    <a href="<?=route('admin.showorder',['id'=>$order->id])?>" class="list-group-item latest-order">
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="id" style="width:150px">Order ID: <?= $order->id ?></div>
                                <div class="id" style="width:350px">Tanggal Order: <?= date("d-M-Y",strtotime($order->created_at)) ?> </div>
                                <div class="name">Customer Name: <?=$order->name?></div>
                                <div class="status text-primary ml-auto"><?=$order->status?></div> 
                            </div>
                        </div>
                    </a>
                <?php
            };
        }
        if($bulan == '07'){
            $orders = Order::where('status','selesai')->whereMonth('created_at',$bulan)->orderBy('created_at','DESC')->get();
            ?>
                <a href="<?= route('laporan.unduh',['bulan'=>'07']) ?>"><button class="btn btn-primary btn-sm mb-4">Unduh Laporan</button></a></div>
            <?php
            foreach ($orders as $order){
                ?>
                    <a href="<?=route('admin.showorder',['id'=>$order->id])?>" class="list-group-item latest-order">
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="id" style="width:150px">Order ID: <?= $order->id ?></div>
                                <div class="id" style="width:350px">Tanggal Order: <?= date("d-M-Y",strtotime($order->created_at)) ?> </div>
                                <div class="name">Customer Name: <?=$order->name?></div>
                                <div class="status text-primary ml-auto"><?=$order->status?></div> 
                            </div>
                        </div>
                    </a>
                <?php
            };
        }
        if($bulan == '08'){
            $orders = Order::where('status','selesai')->whereMonth('created_at',$bulan)->orderBy('created_at','DESC')->get();
            ?>
                <a href="<?= route('laporan.unduh',['bulan'=>'08']) ?>"><button class="btn btn-primary btn-sm mb-4">Unduh Laporan</button></a></div>
            <?php
            foreach ($orders as $order){
                ?>
                    <a href="<?=route('admin.showorder',['id'=>$order->id])?>" class="list-group-item latest-order">
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="id" style="width:150px">Order ID: <?= $order->id ?></div>
                                <div class="id" style="width:350px">Tanggal Order: <?= date("d-M-Y",strtotime($order->created_at)) ?> </div>
                                <div class="name">Customer Name: <?=$order->name?></div>
                                <div class="status text-primary ml-auto"><?=$order->status?></div> 
                            </div>
                        </div>
                    </a>
                <?php
            };
        }
        if($bulan == '09'){
            $orders = Order::where('status','selesai')->whereMonth('created_at',$bulan)->orderBy('created_at','DESC')->get();
            ?>
                <a href="<?= route('laporan.unduh',['bulan'=>'09']) ?>"><button class="btn btn-primary btn-sm mb-4">Unduh Laporan</button></a></div>
            <?php
            foreach ($orders as $order){
                ?>
                    <a href="<?=route('admin.showorder',['id'=>$order->id])?>" class="list-group-item latest-order">
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="id" style="width:150px">Order ID: <?= $order->id ?></div>
                                <div class="id" style="width:350px">Tanggal Order: <?= date("d-M-Y",strtotime($order->created_at)) ?> </div>
                                <div class="name">Customer Name: <?=$order->name?></div>
                                <div class="status text-primary ml-auto"><?=$order->status?></div> 
                            </div>
                        </div>
                    </a>
                <?php
            };
        }
        if($bulan == '10'){
            $orders = Order::where('status','selesai')->whereMonth('created_at',$bulan)->orderBy('created_at','DESC')->get();
            ?>
                <a href="<?= route('laporan.unduh',['bulan'=>'10']) ?>"><button class="btn btn-primary btn-sm mb-4">Unduh Laporan</button></a></div>
            <?php
            foreach ($orders as $order){
                ?>
                    <a href="<?=route('admin.showorder',['id'=>$order->id])?>" class="list-group-item latest-order">
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="id" style="width:150px">Order ID: <?= $order->id ?></div>
                                <div class="id" style="width:350px">Tanggal Order: <?= date("d-M-Y",strtotime($order->created_at)) ?> </div>
                                <div class="name">Customer Name: <?=$order->name?></div>
                                <div class="status text-primary ml-auto"><?=$order->status?></div> 
                            </div>
                        </div>
                    </a>
                <?php
            };
        }
        if($bulan == '11'){
            $orders = Order::where('status','selesai')->whereMonth('created_at',$bulan)->orderBy('created_at','DESC')->get();
            ?>
                <a href="<?= route('laporan.unduh',['bulan'=>'11']) ?>"><button class="btn btn-primary btn-sm mb-4">Unduh Laporan</button></a></div>
            <?php
            foreach ($orders as $order){
                ?>
                    <a href="<?=route('admin.showorder',['id'=>$order->id])?>" class="list-group-item latest-order">
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="id" style="width:150px">Order ID: <?= $order->id ?></div>
                                <div class="id" style="width:350px">Tanggal Order: <?= date("d-M-Y",strtotime($order->created_at)) ?> </div>
                                <div class="name">Customer Name: <?=$order->name?></div>
                                <div class="status text-primary ml-auto"><?=$order->status?></div> 
                            </div>
                        </div>
                    </a>
                <?php
            };
        }
        if($bulan == '12'){
            $orders = Order::where('status','selesai')->whereMonth('created_at',$bulan)->orderBy('created_at','DESC')->get();
            ?>
                <a href="<?= route('laporan.unduh',['bulan'=>'12']) ?>"><button class="btn btn-primary btn-sm mb-4">Unduh Laporan</button></a></div>
            <?php
            foreach ($orders as $order){
                ?>
                    <a href="<?=route('admin.showorder',['id'=>$order->id])?>" class="list-group-item latest-order">
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="id" style="width:150px">Order ID: <?= $order->id ?></div>
                                <div class="id" style="width:350px">Tanggal Order: <?= date("d-M-Y",strtotime($order->created_at)) ?> </div>
                                <div class="name">Customer Name: <?=$order->name?></div>
                                <div class="status text-primary ml-auto"><?=$order->status?></div> 
                            </div>
                        </div>
                    </a>
                <?php
            };
        }
    }

    public function laporanUnduh($bulan)
    {
        if($bulan == '01'){
            $month = 'Januari';
        }
        if($bulan == '02'){
            $month = 'Februari';
        }
        if($bulan == '03'){
            $month = 'Maret';
        }
        if($bulan == '04'){
            $month = 'April';
        }
        if($bulan == '05'){
            $month = 'Mei';
        }
        if($bulan == '06'){
            $month = 'Juni';
        }
        if($bulan == '07'){
            $month = 'Juli';
        }
        if($bulan == '08'){
            $month = 'Agustus';
        }
        if($bulan == '09'){
            $month = 'September';
        }
        if($bulan == '10'){
            $month = 'Oktober';
        }
        if($bulan == '11'){
            $month = 'November';
        }
        if($bulan == '12'){
            $month = 'Desember';
        }

        $orders =Order::where('status','selesai')->whereMonth('created_at',$bulan)->orderBy('created_at','DESC')->get();
        $orders->transform(function($orders,$key){
            $orders->cart = unserialize($orders->cart);
            return $orders;
        });

        $pdf = PDF::loadview('admin.laporanpdf',compact('orders','month'))->setPaper('a4', 'landscape');
    	return $pdf->download(date('dmyHi').'-'.strtoupper(str_replace(' ','_','laporan-bulan-'.$bulan)).'.pdf');
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

    public function editUserform($id)
    {
        $user = DB::table('users')->leftjoin('profiles','users.id','=','profiles.user_id')->where('users.id',$id)->where('profiles.user_id',$id)->first();
        return view('admin.edituser',compact('user'));
    }

    public function editUser(Request $request,$id)
    {
        $this->validate(request(),[
            'name'=>'required|string',
            'email'=>'required',
            'phonenumber'=>'required',
            'city'=>'required',
            'address'=>'required',
        ]);

            $user = User::findOrFail($id);
            $user->name=request('name');
            $user->email=request('email');
            $user->save();

            $profile = Profile::where('user_id',$id)->first();
            $profile->phonenumber=request('phonenumber');
            $profile->city=request('city');
            $profile->address=request('address');
            $profile->save();
        return redirect()->route('admin.user')->with('success','Successfully edited the customer!');
        
    }
    
    public function removeUser($id)
    {
        User::where('id',$id)->delete();
        Profile::where('user_id',$id)->delete();

        return redirect()->route('admin.user')->with('success','Successfully removed the customer!');
    }

    public function updatereminder()
    {
        $reminder= Reminder::find(1);
        $reminder->reminder = request('reminder');
        $reminder->save();

        return redirect()->route('admin.index')->with('success','Successfully updated the reminder!');
    }


}