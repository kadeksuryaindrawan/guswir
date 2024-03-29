@extends('layouts.app')

@section ('content')


    @if(!$pembelians->isEmpty())
    <div class="container sixtyvh">
    <div class="row ml-2 mr-2">
        <div class="col-12">
            @if(Session::has('success'))
            <div class="row">
                <div class="col-12">
                <div id="charge-message" class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                </div>
            </div>
            @endif
            <h3>PURCHASE HISTORY</h3>
            <hr>
            <div class="row d-flex ">
                @foreach($pembelians as $pembelian)
                <div class="col-sm-12 col-md-8 col-lg-8 d-flex order-history mx-auto">
                    <div class="row">
                        @foreach ($pembelian->cart->items as $item)
                            <div class="col-12 d-flex justify-content-between ">
                                <div class="order-image">
                                    <img src="{{ asset('/storage/'.$item['item']['image']) }}" alt="">
                                </div>

                                <div class="order-detail mr-auto d-flex flex-column justify-content-center">
                                    <div class="detail-1">
                                        <h5>{{ $item['item']['name'] }}</h5>
                                    </div>
                                    <div class="detail-3">
                                        <h6>Quantity: {{ $item['quantity'] }}</h6>
                                    </div>
                                    <div class="detail-4">
                                        <h6>Price: Rp. {{ number_format($item['price'],0,",",".") }}</h6>
                                    </div>
                                    @if ($pembelian->status == 'selesai')
                                    <div class="detail-4">
                                        <a href="{{ Route('ulasan.show',['id'=>$item['produk_id']]) }}"><button class="btn btn-success btn-sm">Beri Ulasan</button></a>
                                    </div>
                                    @endif
                                    
                                </div> 
                            </div>
                        @endforeach
                    </div>                      
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 d-flex flex-column justify-content-center mx-auto order-info">
                    <div class="row d-flex   ">
                        <div class="col-4 ">
                            <h6>ID</h6>
                            <h6>Date </h6>
                            <h6>Ongkir </h6>
                            <h6>Total Price</h6>
                            <h6>Status Bayar</h6>
                            
                        </div>
                        <div class="col-8">
                            <h6>: {{ $pembelian['id'] }}</h6>
                            <h6>: {{ $pembelian['created_at'] }}</h6>
                            <h6>: Rp. {{ number_format($pembelian['ongkir'],0,",",".") }}</h6>
                            <h6>: Rp. {{ number_format( ($pembelian->cart->totalPrice + $pembelian['ongkir']),0,",",".") }}</h6>
                            @if ($pembelian['status'] == 'belum bayar')
                                <h6 class="text-danger">: {{ $pembelian['status'] }}</h6>
                            @endif
                            @if ($pembelian['status'] == 'sudah bayar')
                                <h6 class="text-success">: {{ $pembelian['status'] }}</h6>
                            @endif
                            @if ($pembelian['status'] == 'selesai')
                                <h6 class="text-primary">: {{ $pembelian['status'] }}</h6>
                            @endif
                            
                        </div>
                        @if ($pembelian['status'] == 'belum bayar')
                        <div class="col-12">
                            <h6><a href="{{ Route('pembelian.upload',['id'=>$pembelian['id']]) }}"><button class="btn btn-primary btn-sm">Upload Bukti</button></a></h6>
                        </div>
                        @endif
                        
                    </div>

                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>

    @else
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex flex-column justify-content-center align-items-center sixtyvh empty-history">
                    <div><i class="fa fa-th-list"></i></div>
                    <div><h4><b>Your purchase history is empty.</b></h4></div>
                    <div><a href="{{ route('product.index') }}">Go grab some product first :)</a></div>
                </div>
            </div>
        </div>
        
    @endif


@endsection