@extends('layouts.admin')

@section ('content')

<div class="col-12 col-md-12 col-sm-12 col-lg-10">
    @if(Session::has('success'))
    <div class="row">
      <div class="col-12">
        <div id="charge-message" class="alert alert-success">
          {{ Session::get('success') }}
        </div>
      </div>
    </div>
    @endif
    <div class="row">
        <div class="col-4 totaluser">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-user"> USER</i>
                </div>
                <div class="card-body">
                    <h5>{{ $totaluser }}</h5>
                </div>
            </div>
        </div>
        <div class="col-4 totalpembelian">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-dropbox"> PEMBELIAN</i> 
                </div>
                <div class="card-body">
                    <h5>{{ $totalpembelian }} </h5>
                </div>
            </div>
        </div>
        <div class="col-4 totalgross">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-money"> GROSS</i>
                </div>
                <div class="card-body">
                    
                    <h5>Rp. {{ number_format( $totalgross,0,",",".") }}</h5>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-sm-12 col-lg-12 latestpembelian mt-4">
            <div class="card">
                <div class="card-header">
                    PEMBELIAN TERAKHIR
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($latest as $pembelian)
                        <a href="{{ route('admin.showpembelian',['id'=>$pembelian->id]) }}" class="list-group-item latest-pembelian">
                            <div class="row">
                                <div class="col-12 d-flex">
                                    <div class="id" style="width:150px">pembelian ID: {{ $pembelian->id }}</div>
                                    <div class="name">Customer Name: {{ $pembelian->name }}</div>
                                    @if ($pembelian->status == 'belum bayar')
                                        <div class="status text-danger ml-auto">{{ $pembelian->status }}</div>
                                    @endif
                                    @if ($pembelian->status == 'sudah bayar')
                                        <div class="status text-success ml-auto">{{ $pembelian->status }}</div>
                                    @endif
                                    @if ($pembelian->status == 'selesai')
                                        <div class="status text-primary ml-auto">{{ $pembelian->status }}</div>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection