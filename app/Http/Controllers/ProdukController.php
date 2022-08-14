<?php

namespace App\Http\Controllers;

use App;
use App\Produk;
use App\Cart;
use App\BeriNilai;
use Illuminate\Http\Request;
use DB;
use Session;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::where('quantity','!=',0)->get();
        $maxPrice = Produk::select('price')->max('price');
        $minPrice = Produk::select('price')->min('price');
        return view('produk.index',compact(['maxPrice','minPrice','produks']));
        
    }

    public function filter(Request $request)
    {
        if($request->ajax())
        {
            $produks= Produk::where('quantity','>',0);
            $query = json_decode($request->get('query'));
            $price = json_decode($request->get('price'));
            
            if(!empty($query))
            {
                $produks= $produks->where('name','like','%'.$query.'%');        
            }
            if(!empty($price))
            {
                $produks= $produks->where('price','<=',$price);
            }
            $produks=$produks->get();
            

            $total_row = $produks->count();
            if($total_row>0)
            {
                $output ='';
                foreach($produks as $produk)
                {
                    $output .='
                    <div class="col-lg-4 col-md-6 col-sm-12 pt-3">
                        <div class="card">
                            <a href="produk/'.$produk->id.'">
                                <div class="card-body ">
                                    <div class="product-info">
                                    
                                    <div class="info-1"><img src="'.asset('/storage/'.$produk->image).'" alt=""></div>
                                    <div class="info-2"><h4>'.$produk->name.'</h4></div>
                                    <div class="info-3 text-bold"><h5>Rp. '.number_format($produk->price,0,",",".").'</h5></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                    </div>
                    ';
                }
            }
            else
            {
                $output='
                <div class="col-lg-4 col-md-6 col-sm-6 pt-3">
                    <h4>No Data Found</h4>
                </div>
                ';
            }
            $data = array(
                'table_data'    =>$output
            );
            echo json_encode($data);
        
        }
    }

    public function show(Produk $produk)
    {   
        $ulasan = DB::table('beri_nilais')
                     ->select(DB::raw('AVG(ulasan) as ulasan, produk_id'))
                     ->where('produk_id', '=', $produk->id)
                     ->groupBy('produk_id')
                     ->first();
        $ulasans = BeriNilai::where('produk_id',$produk->id)->get();
        return view('produk.show', compact ('produk','ulasan','ulasans'));
    }

    public function form()
    {
        return view('admin.addproduk');
    }

    public function create(Request $request)
    {
        $this->validate(request(),[
            'image'=>'required|image',
            'name'=>'required|string',
            'price'=>'required|integer',
        ]);

        $imagepath = $request->image->store('produks','public');

        
        $produk = new Produk();
        $produk->name=request('name');
        $produk->price=request('price');
        $produk->image=$imagepath;
        $produk->quantity=request('quantity');
        $produk->save();

        // DB:: table('produks')->insert($produk);
        return redirect()->route('admin.produk')->with('success','Successfully added the produk!');
    }
    
    public function editform($id)
    {
        $produk = produk::findOrFail($id);
        return view('admin.editproduk',compact('produk'));
    }

    public function edit(Request $request,$id)
    {
        $this->validate(request(),[
            'image'=>'',
            'name'=>'required|string',
            'price'=>'required|integer',
            'quantity'=>'required|integer',
        ]);
        if(request('image'))
        {
            $imagepath = $request->image->store('produks','public');
            $produk = Produk::findOrFail($id);
            
            $produk->name=request('name');
            $produk->price=request('price');
            $produk->quantity=request('quantity');
            $produk->image=$imagepath;
            $produk->save();
        }
        else
        {
            $produk = Produk::findOrFail($id);
            $produk->name=request('name');
            $produk->price=request('price');
            $produk->quantity=request('quantity');
            $produk->save();
        }
        return redirect()->route('admin.produk')->with('success','Successfully edited the produk!');
        
    }
    
    public function remove($id)
    {
        Produk::where('id',$id)->delete();

        return redirect()->route('admin.produk')->with('success','Successfully removed the produk!');
    }

    public function list()
    {
        $produks = Produk::orderBy('id')->get();
        //dd($produks);
        return view('admin.produk', compact ('produks'));
    }


}