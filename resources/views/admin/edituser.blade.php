@extends('layouts.admin')

@section ('content')

<div class="col-12 col-md-12 col-sm-12 col-lg-10">
    <h5>EDIT CUSTOMER</h5>
    <hr>

    <form method="POST" action="{{ route('user.edit',['id'=>$user->id]) }}">
        @csrf
        @method('PATCH')
        <div class="row ">

            <div class="col-12">
                <label for="name" class="">{{ __('Name') }}</label>
                <div class="form-group">
                    <div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name}}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-12">
                <label for="Email" class="">{{ __('Email') }}</label>
                <div class="form-group">
                    <div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email  }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="col-12">
                <label for="phonenumber" class="">{{ __('Phone') }}</label>
                <div class="form-group">
                    <div>
                        <input id="phonenumber" type="number" class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber" value="{{ old('phonenumber') ?? $user->phonenumber  }}" required autocomplete="phonenumber" autofocus>
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
                            @php
                                $denpasar = ($user->city == 'Denpasar') ? 'selected' : '';
                                $badung = ($user->city == 'Badung') ? 'selected' : '';
                                $bangli = ($user->city == 'Bangli') ? 'selected' : '';
                                $buleleng = ($user->city == 'Buleleng') ? 'selected' : '';
                                $gianyar = ($user->city == 'Gianyar') ? 'selected' : '';
                                $jembrana = ($user->city == 'Jembrana') ? 'selected' : '';
                                $karangasem = ($user->city == 'Karangasem') ? 'selected' : '';
                                $klungkung = ($user->city == 'Klungkung') ? 'selected' : '';
                                $tabanan = ($user->city == 'Tabanan') ? 'selected' : '';
                            @endphp
                            <option value="Denpasar" {{ $denpasar }}>Denpasar</option>
                            <option value="Badung" {{ $badung }}>Badung</option>
                            <option value="Bangli" {{ $bangli }}>Bangli</option>
                            <option value="Buleleng" {{ $buleleng }}>Buleleng</option>
                            <option value="Gianyar" {{ $gianyar }}>Gianyar</option>
                            <option value="Jembrana" {{ $jembrana }}>Jembrana</option>
                            <option value="Karangasem" {{ $karangasem }}>Karangasem</option>
                            <option value="Klungkung" {{ $klungkung }}>Klungkung</option>
                            <option value="Tabanan" {{ $tabanan }}>Tabanan</option>
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
                <label for="address" class="">{{ __('Address') }}</label>
    
                <div class="form-group">
                    <div>
                        <textarea name="address" class="form-control" required>{{ old('address') ?? $user->address }}</textarea>
    
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            


        </div>
        
        <button type="submit" class="btn btn-success w-100">EDIT CUSTOMER</button>
    
    </form>

</div>
    
@endsection