<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $product_id=Product::all();
        //dd($product_id);
        return view('admin.stock',compact('product_id'));
    }

    public function show(Request $request)
    {
        if($request->ajax())
        {
            $id = json_decode($request->get('id'));
            $stock = Stock:: where('product_id',$id);
           
            $stock=$stock->orderBy('product_id', 'ASC')->get();
            

            $total_row = $stock->count();
            if($total_row>0)
            {
                $output ='';
                foreach($stock as $stock)
                {
                    $output .='
                    <tr >
                    <td>
                        '.$stock->quantity.'
                    </td>
                    <td>
                          <a href="/admin-stock/edit/'.$stock->id.'" class="btn btn-primary  m-1" style="color:white; width:100px;">EDIT</a>
                    
                    </td>

                    </tr>
              
                    ';
                }
            }
            else
            {
                $output='
                <div class="col-lg-4 col-md-6 col-sm-6 pt-3">
                    <h4>Tidak Ada Stok</h4>
                </div>
                ';
            }
            $data = array(
                'table_data'    =>$output
            );
            echo json_encode($data);
        
        }
    }

    

    public function editform($id)
    {
        $stock=Stock::findOrFail($id);
        return view('admin.editstock',compact('stock'));
    }

    public function editstock(Request $request, $id)
    {
        $this->validate(request(),[
            'quantity'=>'required|integer',
        ]);

        $stock=Stock::findOrFail($id);
        if(request('quantity') >= 0){
            $stock->quantity=request('quantity');
            $stock->save();
        
            return redirect()->route('admin.stock')->with('success','Sukses edit stok!');
        }
        else{
            return redirect()->route('admin.stock')->with('error','Stok tidak boleh kurang dari 0!');
        }
        
    }


}