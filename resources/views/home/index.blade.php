@extends('layouts.app')

@section ('content')

<div class="container p-0">
  @if(Session::has('success'))
  <div class="row">
    <div class="col-12">
      <div id="charge-message" class="alert alert-success">
        {{ Session::get('success') }}
      </div>
    </div>
  </div>
  @endif
  <!-- GET FIT FROM HOME [S]-->
    <div class="row">
      <div class="col-12 promowrap">
        <div class="row m-0 p-0">
          <div class="col-4 promo-info h-100">
            <div class="infowrapper d-flex flex-column h-100 justify-content-center">
              <h2>LEBIH MUDAH</h2>
              <h4>BELI KAIN ENDEK LEBIH MUDAH</h4>
              <p>Di Toko Komang Martini Sekarang!</p>
              <a href="{{ route('produk.index') }}" class="w-100 button">SHOP NOW</a>
            </div>   
          </div> 
        </div>
        <img class="d-block w-100" src="{{ asset('photo/background.jpg') }}" alt="">
      </div>
    </div>
    <!-- GET FIT FROM HOME [E]-->

    <!-- MEN & WOMEN [S]-->
    

        <!-- CATEGORY [S]-->
        {{-- <div class="row m-0 pt-4">
          <div class="col-lg-4 col-sm-12 d-flex flex-column align-items-center categorywrapper">
            <a href="{{ route('produk.index') }}">
              <div class="category">
                <img class="" height="200px" src="{{ asset('photo/shoes.png') }}" alt="">
                <h5 class="pt-2">SHOES</h5>
              </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-12 d-flex flex-column align-items-center categorywrapper">
            <a href="#">
              <div class="category">
                <img class="" height="200px" src="{{ asset('photo/shirt.png') }}" alt="">
                <h5 class="pt-2">CLOTHING</h5>
            </div>
            </a>
          </div>
          <div class="col-lg-4 col-sm-12 d-flex flex-column align-items-center categorywrapper">
            <a href="#">
              <div class="category">
                <img class="" height="200px" src="{{ asset('photo/bag.png') }}" alt="">
                <h5 class="pt-2">ACCESORIES</h5>
              </div>
            </a>
          </div>
        </div> --}}
        <!-- CATEGORY [E]-->

    <!-- FEATURED SHOES [S]-->
    <h2 class="pt-4">LATEST PRODUCTS</h2>
    <div class="row d-flex justify-content-center">
      @foreach ($produks as $produk)    
      <div class="col-lg-3 col-md-6 col-sm-6 col-6 pt-3">
        <div class="card">
          <a href="{{ route('produk.show',['produk'=>$produk->id]) }}">
            <div class="card-body ">
              <div class="product-info">
                <div class="info-1"><img src="{{ asset('/storage/'.$produk->image) }}" alt=""></div>
                <div class="info-4"><h5>{{ $produk->brand }}</h5></div>
                <div class="info-2"><a href="produk/{{ $produk->id }}"><h4>{{ $produk->name }}</h4></a></div>
                <div class="info-3"><h5>Rp. {{ number_format($produk->price,0,",",".") }}</h5></div>
              </div>
            </div>
          </a>
        </div>
      </div>
      @endforeach
    </div>
    <!-- FEATURED SHOES [E]-->

    

</div>

@endsection