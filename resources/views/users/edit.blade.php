@extends('layouts.app')

@section('title')
    <title> {{  __('Editar usuario') }} </title>
@endsection

@section('content')
    <div class="row container-fluid mt-4">
        <div class="row">
            <div class="col-md-4 col-xs-12 text-center border-right align-content-center justify-content-center">
                <img class="imgperfil rounded-circle w-50 h-40" src="{{ asset('images/usu1.png') }}">
                <h4 class="mt-4">{{ $user->email }}</h4>
            </div>
            <div class="col">
                <form action="{{ route('users.update', ['id'=>$user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mt-5">
                        <div class="col-md-6 col-xs-12 px-5">
                            <h3 class="pb-4">Tu perfil</h3>
                            <div class="mb-3 perfilForm">
                                <label class="form-label" for="name">{{ __('Nombre') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                @error('name')
                                    <p style="color:red;"> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3 perfilForm">
                                <label class="form-label" for="surname1">{{ __('Primer Apellido') }}</label>
                                <input type="text" class="form-control" name="surname1" value="{{ $user->surname1 }}">
                                @error('surname1')
                                    <p style="color:red;"> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3 perfilForm">
                                <label class="form-label" for="surname2">{{ __('Segundo Apellido') }}</label>
                                <input type="text" class="form-control" name="surname2" value="{{ $user->surname2 }}">
                                @error('surname2')
                                    <p style="color:red;"> {{ $message }} </p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-12 px-5">
                            <div class="mb-3 perfilForm">
                                <label class="form-label" for="email ">{{ __('Email') }}</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                @error('email')
                                    <p style="color:red;"> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3 perfilForm">
                                <label class="form-label" for="phone ">{{ __('Teléfono') }}</label>
                                <input type="phone" class="form-control" name="phone" value="{{ $user->phone }}">
                                @error('phone')
                                    <p style="color:red;"> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3 perfilForm">
                                <label for="others" class="form-label">{{ __('Cuéntanos algo más') }}</label><br>
                                <textarea class="form-label" rows="4" cols="40" name="others">{{ $user->others }}</textarea>
                                @error('others')
                                    <p style="color:red;"> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="edit">
                                {{-- <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button> --}}
                                @include("modals/save_user_changes")
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#saveUserChangesModel">{{ __('Actualizar') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection