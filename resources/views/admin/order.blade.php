@extends('layouts.admin')

@section ('content')

<div class="col-12 col-md-12 col-sm-12 col-lg-10">
    <div class="card">
        <div class="card-header">
            <h5>ORDER LIST</h5>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @foreach ($orders as $order)
                <a href="{{ route('admin.showorder',['id'=>$order->id]) }}" class="list-group-item latest-order">
                    <div class="row">
                        <div class="col-12 d-flex">
                            <div class="id" style="width:150px">Order ID: {{ $order->id }}</div>
                            <div class="name">Customer Name: {{ $order->name }}</div>
                            @if ($order->status == 'belum bayar')
                                <div class="status text-danger ml-auto">{{ $order->status }}</div> 
                            @endif
                            @if ($order->status == 'sudah bayar')
                                <div class="status text-success ml-auto">{{ $order->status }}</div> 
                            @endif
                            @if ($order->status == 'selesai')
                                <div class="status text-primary ml-auto">{{ $order->status }}</div> 
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