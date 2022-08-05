@extends('layouts.app')

@section ('content')

<div class="container p-0 show">
   <div class="row sixtyvh">
       <div class="col-lg-8 col-sm-12 mb-3 show-picture">
            <img src="{{ asset('/storage/'.$product->image) }}" alt="">
       </div>
       <div class="col-lg-4 col-sm-12 pl-5 pr-5">
        <h5>{{ $product->name }}</h5>
        @if ($ulasan != NULL)
        <h6>Rating : {{ round($ulasan->ulasan,1) }} / 5</h6>
        @endif
        @if ($ulasan == NULL)
        <h6>Rating : 0 / 5</h6>
        @endif
        
            <div class="card">
                <div class="card-body">
                    <div class="show-info">
                        <div class="info-1">
                            <h6>BUY NEW</h6>
                        </div>
                        <div class="info-3">
                            <p>This product is pre-verified, and will be ready to ship instantly. Expedited shipping options will be available in checkout.
                            </p>
                        </div>
                        <form action="{{ route('cart.add',['product'=>$product->id]) }}" method="GET">
                            @csrf
                            <label for="qty">Jumlah :</label>
                            <input type="number" class="form-control" name="qty" id="qty" value="1">
                            <button type="submit" class="btn btn-primary w-100 mt-3">ADD TO CART</button>
                        </form>
                        {{-- <a href="{{ route('cart.add',['product'=>$product->id]) }}" id="add-to-cart" class="add-to-cart">
                            
                            <div class="info-4">
                                ADD TO CART
                            </div>
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
   </div>
</div>

@endsection