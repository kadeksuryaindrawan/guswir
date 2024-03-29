<?php

namespace App\Http\Controllers;
use PDF;
use App\User;
use App\Pembelian;
use Illuminate\Http\Request;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        $totalgross = 0;

        $users = User::where('role','Customer')->get();
        $totaluser = count($users);

        $pembelians = Pembelian::get();
        $totalpembelian = count($pembelians);
     
        
        $gross = Pembelian::where('status','selesai')->get();
        $gross->transform(function($pembelian,$key){
            $pembelian->cart = unserialize($pembelian->cart);
            return $pembelian;
        });

        foreach ($gross as $x){
           $totalgross+= $x->cart->totalPrice + $x->ongkir;
        }


        $latest=Pembelian::orderBy('created_at','DESC')->take(5)->get();
        
        return view('admin.index',compact('latest','totaluser','totalpembelian','totalgross'));
    }

    public function pembelian()
    {
        $pembelians=Pembelian::where('status','selesai')->orderBy('created_at','DESC')->get();
        
        return view('admin.pembelian',compact('pembelians'));
    }

    public function pembelianAcc($id)
    {
        
        $pembelian = Pembelian::findOrFail($id);
        $email = $pembelian->user->email;
        $name = $pembelian->user->name;
        $status = 'Pesanan Berhasil';
        $article = [
            'name'=>$name,
            'id' => $id,
            'body' =>'
    Pesanan kamu dengan pembelianID '.$id.' telah dikonfirmasi oleh Admin Toko Komang Martini.

    Pesanan kamu telah selesai. Terima kasih sudah belanja di Toko Komang Martini.',
        ];
        $pembelian->status='selesai';
        $pembelian->save();
        Mail::to($email)->send(new UserNotification($article,$status));
        $pembelians=Pembelian::where('status','selesai')->orderBy('created_at','DESC')->get();
        return view('admin.pembelian',compact('pembelians'));
    }

    public function pembelianDel($id)
    {
        
        $pembelian = Pembelian::findOrFail($id);
        $bukti_path = public_path().'/storage/'.$pembelian->bukti_bayar;
        unlink($bukti_path);
        $email = $pembelian->user->email;
        $name = $pembelian->user->name;
        $status = 'Pesanan Gagal';
        $article = [
            'name'=>$name,
            'id' => $id,
            'body' =>'
    Pesanan kamu dengan pembelianID '.$id.' telah ditolak oleh Admin Toko Komang Martini.

    Pesanan kamu belum selesai. Silahkan upload ulang bukti pembayaran.',
        ];
        $pembelian->status='belum bayar';
        $pembelian->bukti_bayar=NULL;
        $pembelian->save();
        Mail::to($email)->send(new UserNotification($article,$status));
        $pembelians=Pembelian::where('status','sudah bayar')->orWhere('status','belum bayar')->orderBy('created_at','DESC')->get();
        return view('admin.pembelian',compact('pembelians'));
    }

    public function pembelianBaru()
    {
        $pembelians=Pembelian::where('status','sudah bayar')->orWhere('status','belum bayar')->orderBy('created_at','DESC')->get();
        
        return view('admin.pembelian',compact('pembelians'));
    }

    public function laporan()
    {
        return view('admin.laporan');
    }

    public function laporanBulan(Request $request)
    {
        $bulan = $request->bulan;
        ?>
        <option value="">Pilih tahun</option>
            <option value="<?=$bulan?> 2020">2020</option>
            <option value="<?=$bulan?> 2021">2021</option>
            <option value="<?=$bulan?> 2022">2022</option>
            <option value="<?=$bulan?> 2023">2023</option>
            <option value="<?=$bulan?> 2024">2024</option>
            <option value="<?=$bulan?> 2025">2025</option>
            <option value="<?=$bulan?> 2026">2026</option> 
            <option value="<?=$bulan?> 2027">2027</option> 
            <option value="<?=$bulan?> 2028">2028</option>       
        
        <?php
        
        
    }

    public function laporanTahun(Request $request)
    {
        
        $format = $request->tahun;
        $pecah = explode(" ",$format);
        for($i = 0; $i < count( $pecah ); $i++){
            $pecah[$i];
        }
        $bulan = $pecah[0];
        $tahun = $pecah[1];

            $pembelians = Pembelian::where('status','selesai')->whereMonth('created_at',$bulan)->whereYear('created_at',$tahun)->orderBy('created_at','DESC')->get();
            ?>
                <a href="<?= route('laporan.unduh',['bulan'=>$bulan,'tahun'=>$tahun]) ?>"><button class="btn btn-primary btn-sm mb-4">Unduh Laporan</button></a></div>
            <?php
            foreach ($pembelians as $pembelian){
                ?>
                    <a href="<?=route('admin.showpembelian',['id'=>$pembelian->id])?>" class="list-group-item latest-pembelian">
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="id" style="width:150px">pembelian ID: <?= $pembelian->id ?></div>
                                <div class="id" style="width:350px">Tanggal pembelian: <?= date("d-M-Y",strtotime($pembelian->created_at)) ?> </div>
                                <div class="name">Customer Name: <?=$pembelian->name?></div>
                                <div class="status text-primary ml-auto"><?=$pembelian->status?></div> 
                            </div>
                        </div>
                    </a>
                <?php
            };
        
    }

    public function laporanUnduh($bulan,$tahun)
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

        $pembelians =Pembelian::where('status','selesai')->whereMonth('created_at',$bulan)->whereYear('created_at',$tahun)->orderBy('created_at','DESC')->get();
        $pembelians->transform(function($pembelians,$key){
            $pembelians->cart = unserialize($pembelians->cart);
            return $pembelians;
        });

        $pdf = PDF::loadview('admin.laporanpdf',compact('pembelians','month','tahun'))->setPaper('a4', 'landscape');
    	return $pdf->download(date('dmyHi').'-'.strtoupper(str_replace(' ','_','laporan-bulan-'.$bulan.'-tahun-'.$tahun)).'.pdf');
    }

    public function show_pembelian($id)
    {
        $ids =DB::table('pembelians')->where('id',$id)->get();

        $pembelian =DB::table('pembelians')->where('id',$id)->get();
        $pembelian->transform(function($pembelian,$key){
            $pembelian->cart = unserialize($pembelian->cart);
            return $pembelian;
        });
        return view('admin.showpembelian',compact('pembelian','ids'));
    }

    public function user()
    {
        $users=DB::table('users')->where('role','Customer')->get();
        return view('admin.user',compact('users'));
    }

    public function editUserform($id)
    {
        $user = DB::table('users')->where('id',$id)->first();
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
            $user->phonenumber=request('phonenumber');
            $user->city=request('city');
            $user->address=request('address');
            $user->save();
        return redirect()->route('admin.user')->with('success','Successfully edited the customer!');
        
    }
    
    public function removeUser($id)
    {
        User::where('id',$id)->delete();

        return redirect()->route('admin.user')->with('success','Successfully removed the customer!');
    }


}