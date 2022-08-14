@extends('layouts.app')

@section ('content')

<div class="container p-0 show">
   <div class="row sixtyvh">
       <div class="col-lg-8 col-sm-12 mb-3 show-picture">
            <img src="{{ asset('/storage/'.$produk->image) }}" alt="">
       </div>
       <div class="col-lg-4 col-sm-12 pl-5 pr-5">
        <h5>{{ $produk->name }}</h5>
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
                            <p>This produk is pre-verified, and will be ready to ship instantly. Expedited shipping options will be available in checkout.
                            </p>
                        </div>
                        <form action="{{ route('cart.add',['produk'=>$produk->id]) }}" method="GET">
                            @csrf
                            <label for="qty">Jumlah :</label>
                            <input type="number" class="form-control" name="qty" id="qty" value="1">
                            <button type="submit" class="btn btn-primary w-100 mt-3">ADD TO CART</button>
                        </form>
                        {{-- <a href="{{ route('cart.add',['produk'=>$produk->id]) }}" id="add-to-cart" class="add-to-cart">
                            
                            <div class="info-4">
                                ADD TO CART
                            </div>
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <h3 class="h3 mt-5 mb-3">Ulasan Produk</h3>
        </div>
        @foreach ($ulasans as $item)
        <div class="col-12">
            <div class="col-4">
                <a class="example-image-link" href="{{ asset('/storage/'.$item->image) }}" data-lightbox="example-1"><img src="{{ asset('/storage/'.$item->image) }}" alt="" width="75px"></a>
            </div>
            <div class="col-8">
                <h6 class="mt-2">Rating : {{ $item->ulasan }} / 5</h6>
                <h5>{{ $item->user->name }}</h5>
                <p>{{ $item->comment }}</p>
            </div>
            <hr>
        </div>
        @endforeach
        
   </div>
</div>

@endsection