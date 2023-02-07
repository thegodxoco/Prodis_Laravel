@extends('layouts.app')

@section('title')
    <title> {{  __('Gestionar categorias') }} </title>
    <script defer src="{{ asset('js/categories.js') }}"></script>
@endsection

@section('content') 

<div class="container mt-2">
    <div>
        <h1>{{ __('Gestiona categorías') }}</h1>
    </div>

    <div class="position-relative d-flex justify-content-end align-items-center">
        <label class="mx-3 mb-2" for="inputCategory"> {{ __('Escribe la categoría a crear / eliminar:') }} </label>
        <div>
            <input type="text" class="form-control" id="inputCategory">
            <h6 id="category_error" style="color:red"></h6>
        </div>
        @include("modals/create_category")
        <button type="button" style="width:80px;" class="mb-2 text-white btn btn-success col-1 mx-3" data-bs-toggle="modal" data-bs-target="#createCategoryModel">{{ __('Crea') }}</button>

        @include("modals/delete_category")
        <button type="button" style="width:80px;" class="mb-2 btn btn-danger col-1" data-bs-toggle="modal" data-bs-target="#deleteCategoryModel">{{ __('Elimina') }}</button>
    </div>

    <div class="table-responsive">
        <p>{{ __('Lista de las categorías existentes:') }}</p>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">{{ __('Nombre') }}</th>
                </tr>
            </thead>
            <tbody id="categories_table">
                @foreach ( $categories as $category )
                    <tr>
                        <td>{{ $category->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection