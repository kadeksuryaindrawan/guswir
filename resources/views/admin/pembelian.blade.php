@extends('layouts.admin')

@section ('content')

<div class="col-12 col-md-12 col-sm-12 col-lg-10">
    <div class="card">
        <div class="card-header">
            <h5>PEMBELIAN LIST</h5>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($pembelians as $pembelian)
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
    
@endsection