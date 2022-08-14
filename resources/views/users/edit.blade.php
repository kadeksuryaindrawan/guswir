@extends('layouts.app')

@section('content')
<div class="container sixtyvh">
    <form method="POST" action="{{ route('profile.update',['user'=>$user->id])  }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="row">
            
            <div class="col-8 mx-auto">
                <h3 class="offset-md-5">Edit Profile</h3>
                <hr>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name:') }}</label>
        
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}" required autocomplete="name" autofocus>
        
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="phonenumber" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number:') }}</label>
        
                    <div class="col-md-6">
                        <input id="phonenumber" type="number" class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber" value="{{ old('phonenumber') ?? $user->phonenumber  }}" required autocomplete="phonenumber" autofocus>
        
                        @error('phonenumber')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                
                
                <div class="form-group row">
                    <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City:') }}</label>
        
                    <div class="col-md-6">
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
                
                <div class="form-group row">
                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address:') }}</label>
        
                    <div class="col-md-6">
                        <textarea name="address" class="form-control" required>{{ old('address') ?? $user->address }}</textarea>
        
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
        
                
        
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="button-primary w-100">
                            {{ __('Done') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        
    </form>
</div>
@endsection
