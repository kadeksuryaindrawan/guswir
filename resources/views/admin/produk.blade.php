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
    <div class="card">
        <div class="card-header">
            <h5>PRODUCTS LIST</h5>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.addform') }}" class="btn btn-success mb-4" style="color:white; width:150px;">ADD PRODUK</a>
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($produks as $produk)
                  <tr>
                    <th scope="row">{{ $produk->id }}</th>
                    <td><img style="height:100px;" src="{{ asset('/storage/'.$produk->image) }}" alt=""></td>
                    <td>{{ $produk->name }}</td>
                    <td>Rp. {{ number_format($produk->price,0,",",".") }}</td>
                    <td>{{ $produk->quantity }}</td>
                    <td>
                        <a href="{{ route('produk.editform',['id'=>$produk->id]) }}" class="btn btn-primary w-100 m-1" style="color:white;">EDIT</a>
                        <a href="{{ route('produk.remove',['id'=>$produk->id]) }}" class="btn btn-danger w-100 m-1" style="color:white;">REMOVE</a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
    
@endsection