@extends('layouts.app')

@section('title')
    <title> {{ __('Mi perfil') }} </title>
@endsection

@section('content')
    <style>
        .mybuttonoverlap{
            position: absolute;
            z-index: 2;
            top: 49%;
            display: none;
            left: 44%;             
        }
        .mydivouter{
            position:relative;
            /* background: #f90; */
            /* width: 200px; */
            /* height: 120px; */
            margin: 0 auto; 
        }
        .mydivouter:hover .mybuttonoverlap{ 
            display:block;
        }
        .mydivouter:hover .image-hover{ 
            opacity: 0.3;
        }
        .link{
            color:black;
            text-decoration: none;
            font-size: 30px;
        }
        .link:hover{
            color:rgb(107, 107, 107);
        }
        .close:hover{
            color:rgb(107, 107, 107);
        }
    </style>
    <div class="row container-fluid mt-5">
        <div class="row">
            <div class="col-md-4 col-xs-12 text-center border-right align-content-center justify-content-center">
                
                @if ( $user->doesntHaveProfileImage() )
                    <img class="imgperfil rounded-circle w-50 h-40 image-hover" src="{{ asset('images/usu1.png') }}">

                    @include("modals/create_profile_image")
                    <br>
                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#createProfileImageModel">{{ __('Añade') }}</button>
                    @error('profile_image')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror
                @else
                    <div class="mydivouter">
                        <img class="imgperfil rounded-circle image-hover" src="{{ asset('images/users/'.$user->profileImage->image) }}" style="width: 300px; height: 300px; object-fit: cover; box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);">
                        @include("modals/edit_profile_image")
                        @include("modals/delete_profile_image")

                        <div class="mybuttonoverlap">
                            <a class="link" alt="Cambiar imagen">
                                <i class="bi bi-pencil-square" data-bs-toggle="modal" data-bs-target="#editProfileImageModel"></i>
                            </a>
                            <a class="link" alt="Eliminar imagen">
                                <i class="bi bi-trash3-fill" data-bs-toggle="modal" data-bs-target="#deleteProfileImageModel"></i>
                            </a>
                        </div>
                        <!--<div class="mybuttonoverlap">
                            <a class="link" alt="Cambiar imagen">
                                <i class="bi bi-pencil-square" data-bs-toggle="modal" data-bs-target="#editProfileImageModel"></i>
                            </a>
                        </div>-->
                    </div>
                @endif

                <h4 class="mt-4">{{ $user->email }}</h4>
            </div>
            <div class="col">
                <form action="{{ route('users.update') }}" method="POST">
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
                                @include("modals/save_user_changes")
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#saveUserChangesModel">{{ __('Actualizar') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="offers_subscribed_to" class="container mt-5">
        <h3>{{ __('Lista de ofertas a las que está suscrito:') }}</h3>
        @if ($user->offers->count() == 0)
            <h5>{{ __('Actualmente no está suscrito en ninguna oferta') }}</h5>
        @else
            @foreach ($user->offers as $offer)
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $offer->title }}</h5>
                        <p class="card-text">{{ $offer->description }}</p>
                        <a href="/offer/{{ $offer->id }}" class="btn btn-primary">{{ __('Abre la oferta') }}</a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
