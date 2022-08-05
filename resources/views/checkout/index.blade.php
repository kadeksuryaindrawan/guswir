@extends('layouts.app')

@section ('content')

<div class="container">
    <div class="row">
        <div class="col-7 mx-auto">
            <h3>CHECKOUT</h3>
            <hr>
            
            <form action="{{ route('checkout') }}" method="POST" id="checkout-form">
                @csrf
                <div class="row ">
                    
                    <div class="col-12">
                        <h5>SHIPPING DETAILS</h5>
                    </div>

                    <div class="col-12">
                        <label for="name" class="">{{ __('Name') }}</label>
                        <div class="form-group">
                            <div>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name ??'' }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="phonenumber" class="">{{ __('Phone Number') }}</label>
                        <div class="form-group">
                            <div>
                                <input id="phonenumber" type="text" class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber" value="{{ old('phonenumber') ?? $user->profile->phonenumber ??'' }}" required autocomplete="phonenumber" autofocus>
                                @error('phonenumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="city" class="">{{ __('City') }}</label>
                        <div class="form-group">
                            <div>
                                <select name="city" id="city" class="form-control @error('city') is-invalid @enderror">
                                    <option value="">Select City</option>
                                    <option value="Denpasar">Denpasar</option>
                                    <option value="Badung">Badung</option>
                                    <option value="Bangli">Bangli</option>
                                    <option value="Buleleng">Buleleng</option>
                                    <option value="Gianyar">Gianyar</option>
                                    <option value="Jembrana">Jembrana</option>
                                    <option value="Karangasem">Karangasem</option>
                                    <option value="Klungkung">Klungkung</option>
                                    <option value="Tabanan">Tabanan</option>
                                </select>
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="ongkir" class="">{{ __('Ongkir') }}</label>
                        <div class="form-group">
                            <div>
                                <select name="ongkir" id="ongkir" class="form-control" disabled>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="address" class="">{{ __('Address') }}</label>
                        <div class="form-group">
                            <div>
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? $user->profile->address ??'' }}" required autocomplete="address" autofocus>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-12">
                        <label for="bukti" class="">{{ __('Bukti Bayar') }}</label>
                        <div class="form-group">
                            <div>
                                <input id="bukti" type="file" class="form-control @error('bukti') is-invalid @enderror" name="bukti" required  autofocus>
                                @error('bukti')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div> --}}


                </div>
                
                <button type="submit" class="button-primary w-100">BUY NOW</button>
            
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('#city').change(function(event){
            var city = $('#city').val();
            $('#ongkir').removeAttr('disabled');
            $('#ongkir').empty();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ route('city') }}",
                data: 'city='+city,
                success: function(data){
                    $('#ongkir').append(data);
                }
            });
        });
    });
    
</script>

@endsection