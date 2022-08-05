@extends('layouts.app')

@section ('content')

<div class="container sixtyvh">
    <div class="row ml-2 mr-2 mt-5">
        <div class="col-12">
            <form action="{{ Route('ulasan.ulasan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h5 class="text-success">Beri Ulasan Pada Product {{ $product->name }}</h5><br> <br>
                <input type="hidden" value="{{ $product->id }}" name="id">
                
                    <div class="form-group">
                        <label for="ulasan" class="">Pilih Rating Ulasan</label>
                        <select name="ulasan" id="ulasan" class="form-control">
                            <option value="">Pilih Rating</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                <button type="submit" class="btn btn-success w-100">Submit</button>
            </form>
        </div>
    </div>
</div>
    


@endsection