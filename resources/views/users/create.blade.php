@extends('layouts.app')

@section('title')
    <title> {{ __('Crear usuario') }} </title>
    <script defer src="{{ asset('js/offer.js') }}"></script>
@endsection

@section('content')
    <div class="row container-fluid mt-4">
        <div class="row">

            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <h3 class="container row my-3 pb-4">{{ __('Crear usuario') }}</h3>
                <div class="row">
                    <div class="col-md-6 col-xs-12 px-5">
                        <div class="mb-3 perfilForm">
                            <label class="form-label" for="name">{{ __('Nombre') }} *</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            @error('name')
                                <p style="color:red;"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3 perfilForm">
                            <label class="form-label" for="surname1">{{ __('Primer Apellido') }} *</label>
                            <input type="text" class="form-control" name="surname1" value="{{ old('surname1') }}">
                            @error('surname1')
                                <p style="color:red;"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3 perfilForm">
                            <label class="form-label" for="surname2">{{ __('Segundo Apellido') }} *</label>
                            <input type="text" class="form-control" name="surname2" value="{{ old('surname2') }}">
                            @error('surname2')
                                <p style="color:red;"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3 perfilForm">
                            <label class="form-label" for="phone ">{{ __('Teléfono') }} *</label>
                            <input type="phone" class="form-control" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <p style="color:red;"> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12 px-5">
                        <div class="mb-3 perfilForm">
                            <label class="form-label" for="email ">{{ __('Email') }} *</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            @error('email')
                                <p style="color:red;"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Contraseña')}} *</label>                         
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirmar Contraseña') }} *</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>     
                        <div class="mb-3 perfilForm">
                            <label for="others" class="form-label">{{ __('Cuéntanos algo más') }}</label><br>
                            <textarea class="form-label" rows="4" cols="40" name="others">{{ old('others') }}</textarea>
                            @error('others')
                                <p style="color:red;"> {{ $message }} </p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="is_admin" class="form-label">{{ __('Admin') }}</label><br>
                            <input type="checkbox" class="form-check-input" name="is_admin" value="check"> {{--  no funciona OLD - -}}
                            {{-- @error('is_admin')
                                <p style="color:red;"> {{ $message }} </p>
                            @enderror --}}
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12 mb-3">
                                {{ __('*: Campo obligatorio') }}
                            </div>
                        </div>
                        <div class="edit">
                            {{-- <button type="submit" class="btn btn-primary">{{ __('Crear') }}</button> --}}
                            @include("modals/create_user")
                            <button type="button" class="text-white btn btn-block col-3 btn-success" data-bs-toggle="modal" data-bs-target="#createUserModel">{{ __('Crea') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
