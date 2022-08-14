@extends('layouts.app')

@section ('content')

<div class="container sixtyvh">
    <div class="row ml-2 mr-2 mt-5">
        <div class="col-12">
            <form action="{{ Route('pembelian.uploadProcess') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h6 class="text-danger">Transfer ke rekening BCA : 2372837283</h6><br> <br>
                <input type="hidden" value="{{ $pembelian->id }}" name="id">
                
                    <div class="form-group">
                        <label for="bukti" class="">Upload Foto Bukti Bayar</label>
                        <input type="file" class="form-control" id="bukti_bayar" name="bukti_bayar">
                    </div>
                <button type="submit" class="btn btn-success w-100">Upload</button>
            </form>
        </div>
    </div>
</div>
    


@endsection