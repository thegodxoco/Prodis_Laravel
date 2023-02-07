@extends('layouts.app')


@section('title')
    <title> {{  __('Gestionar usuarios') }} </title>
@endsection

@section('content')
    <div class="container mt-2">
        <div>
            <h1>{{ __('Lista de usuarios') }}</h1>
        </div>

        <div class="position-relative">
            <form method="get" action="{{ route('users.create') }}">
                @csrf
                <input type="hidden" name="_method" value="POST">
                <input type="submit" class="bg-success text-white btn position-absolute top-0 end-0 float-end" value="{{ __('Crear usuario') }}"/>
            </form>
            <!--<a style="background-color:#008570" class=" text-white btn position-absolute top-0 end-0 float-end" href="#" role="button">{{ __('Crear usuario') }}</a>-->
        </div>

        <div style="margin-top: 5%;" class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">{{ __('Nombre') }}</th>
                        <th scope="col">{{ __('Primer apellido') }}</th>
                        <th scope="col">{{ __('Segundo apellido') }}</th>
                        <th scope="col">{{ __('Correo electrónico') }}</th>
                        <th scope="col">{{ __('Número de teléfono') }}</th>
                        <th scope="col">{{ __('') }}</th>
                        <th scope="col">{{ __('Rol') }}</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->surname1 }}</td>
                            <td>{{ $user->surname2 }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                            @if (Auth::user()->id == $user->id)
                                <span class="badge text-white bg-success">{{ __('Yo') }}</span></td>
                            @else
                                </td>
                            @endif 
                            @if ($user->admin)
                                <td>
                                    <span class="badge bg-dark">{{ __('Admin') }}</span>
                                    </td>
                                @else
                                    <td></td>
                            @endif 
                                         
                            <td>
                                <div class="d-flex justify-content-start">
                                    <div class="row g-2">
                                        <div class="col-sm">
                                            <form method="post" action="{{ route('users.edit', ['id'=>$user->id]) }}">
                                                @csrf
                                                <input type="hidden" name="_method" value="get">
                                                <input type="submit" class="btn btn-secondary" value="{{ __('Modificar') }}"/>
                                            </form>
                                        </div>

                                        <div class="col-sm">
                                            <form method="post" action="{{ route('users.destroy', ['id'=>$user->id]) }}">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                {{-- <input type="submit" class="btn btn-danger" value="{{ __('Eliminar') }}"/> --}}
                                                @include("modals/delete_user")
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModel{{$user->id}}">{{ __('Eliminar') }}</button>
                                            </form>
                                        </div>                                        
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection