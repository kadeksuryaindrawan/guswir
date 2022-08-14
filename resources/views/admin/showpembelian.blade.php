@extends('layouts.admin')

@section ('content')

<div class="col-12 col-md-12 col-sm-12 col-lg-10">
    <div class="card">
        <div class="card-header">
            <div class="row">
            @foreach ($ids as $id)
            <div class="col-12 col-lg-6 col-md-6 col-sm-12 pt-2">
                <h5>PEMBELIAN DETAILS</h5>
                <hr>
                <div class="row">
                    <div class="col-5">
                        PEMBELIAN ID<br>
                        Buyer ID<br>
                        Buyer Name <br>
                        Phone Number <br>
                        Status <br><br><br>
                        @if ($id->status != 'belum bayar')
                            Bukti Bayar <br>
                        @endif
                        
        
                    </div>
                    <div class="col-7">
                        : {{ $id->id }} <br>
                        : {{ $id->user_id }} <br>
                        : {{ $id->name }} <br>
                        : {{ $id->phonenumber }} <br>
                        : {{ $id->status }} <br>
                        @if ($id->status != 'belum bayar')
                            : <a class="example-image-link" href="{{ asset('/storage/'.$id->bukti_bayar) }}" data-lightbox="example-1"><img style="height:115px;" src="{{ asset('/storage/'.$id->bukti_bayar) }}" alt=""></a>
                             <br>
                        @endif
                    </div>
                </div>
                
            </div>
            

            <div class="col-12 col-lg-6 col-md-6 col-sm-12 pt-2">
                <h5>SHIPPING ADDRESS</h5>
                <hr>
                <div class="row">
                    <div class="col-5">
                        City <br>
                        Address <br>
                        
                    </div>
                    <div class="col-7">
                        : {{ $id->city }} <br>
                        : {{ $id->address }} <br>
                        
                    </div>
                </div>
            </div>
            @if ($id->status == 'sudah bayar')
                <div class="col-12 col-lg-12 col-md-12 col-sm-12 pt-5">
                    <h5>Action</h5>
                    <hr>
                    <div class="row">
                        <div class="col-5">
                            <a href="{{ route('pembelian.acc',['id'=>$id->id]) }}"><button class="btn btn-success btn-sm">Terima Pembayaran</button></a>
                            <a href="{{ route('pembelian.del',['id'=>$id->id]) }}"><button class="btn btn-danger btn-sm">Tolak Pembayaran</button></a>
                        </div>
                        
                    </div>
                </div>
            @endif
            
           @endforeach

        </div>
        </div>
        <div class="card-body">
            @foreach($pembelian as $pembelian)
            <div class="col-sm-12 col-md-12 col-lg-12 d-flex order-history mx-auto">
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
                                    <h6>Price: Rp.   {{ number_format( $item['price'],0,",",".") }}</h6>
                                </div>
                            </div> 
                        </div>
                    @endforeach
                </div>                      
            </div>
            <div class="col-12">
                <h5 class="h3">Ongkir : Rp. {{ number_format( $pembelian->ongkir,0,",",".") }}</h5>
                <h3 class="h3">Total Price : Rp. {{ number_format( ($pembelian->cart->totalPrice + $pembelian->ongkir),0,",",".") }}</h3>
            </div>
            @endforeach
        </div>
    </div>
</div> 
    
@endsection