@extends('layouts.app')

@section('title')
    <title> {{  __('Editar Oferta') }} </title>
    <script defer src="{{ asset('js/offer.js') }}"></script>
@endsection

@section('content')

    <style>
        .mybuttonoverlap{
            position: absolute;
            z-index: 2;
            top: 50%;
            display: none;
            left: 45%;	
        }
        .mydivouter{
            position:relative;
            /* background: #f90; */
            width: 200px;
            /* height: 120px; */
            /* margin: 0 auto; */
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

    <form action="{{ route('offers.update', ['id' => $offer->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="row">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="my-5">Editar oferta {{ $offer->id }}</h1>
                    <a href="{{ route('offer.show', ['id' => $offer->id]) }}"><button class="btn btn-primary m-3" type="button">{{ __("Ver oferta") }}</button></a>      
                </div>
                <div class="col-md-4 m-auto my-2">
                    <label for="title"> {{ __('Título') }} </label>
                    <input type="text" class="form-control" name="title" placeholder="Título" value="{{ $offer->title }}">

                    @error('title')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror

                </div>
                <div class="col-md-4 m-auto my-2">
                    <label for="address"> {{ __('Dirección') }} </label>
                    <input type="text" class="form-control" name="address" placeholder="Dirección" value="{{ $offer->address }}">

                    @error('address')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror

                </div>
            </div>
        
            <div class="row">
                <div class="col-md-4 m-auto my-2">
                    <label for="city"> {{ __('Ciudad') }} </label>
                    <input type="text" class="form-control" name="city" id="ciudad" value="{{ $offer->city }}">

                    @error('city')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror

                </div>
                <div class="col-md-4 m-auto my-2">
                    <label for="province"> {{ __('Provincia') }} </label>
                    <select id="province" name="province" class="form-control"> 
                    <option selected>{{ $offer->province}}</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province }}">{{ $province }}</option>
                    @endforeach 
                    </select>

                    @error('province')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror

                </div>
            </div>
            <div class="row">
                <div class="col-md-4 m-auto my-2">
                    <label for="zip_code"> {{ __('Código postal') }} </label>
                    <input type="number" class="form-control" name="zip_code" id="inputZip" value="{{ $offer->zip_code }}">

                    @error('zip_code')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror
                </div>
                <div class="col-md-4 m-auto my-2"></div>
            </div>
            <div class="row">
                <div class="col-md-4 m-auto my-2">
                    <div class="d-flex flex-column" id="categories">
                        <label for="inputCategory"> {{ __('Elige categoría/s') }} </label>
                        <select class="col-md-4" name="selected_categories[]" multiple style="width: 200px;height: 150px;">
                            @foreach ( $categories as $category )
                                    @if ( in_array($category->name, $off_cat)  )
                                        <option name="select_categories" selected value="{{ $category->name }}">{{ $category->name }}</option>
                                    @else
                                        <option name="select_categories" value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endif
                            @endforeach
                        </select>
                        <p>{{ __('Para seleccionar más de una categoría, mantén presionado la tecla Ctrl.') }}</p>
                    </div>
                </div>
                <div class="col-md-4 m-auto my-2">
                    <div id="requirements">
                        <label for="requirements[]"> {{ __('Requisitos') }} </label>

                        @if( $offer->requirements )
                            @for( $i =0; $i < count($offer->requirements); $i++)
                                <div class="d-flex align-items-center">
                                    <input type="text" value="{{ $offer->requirements[$i]}}"  name="requirements[]" class="form-control mt-2" />
                                    <i id="first_req" class="bi bi-trash3-fill close mt-1" style="margin-left:5px;" class="btn-close" aria-label="Close"></i>
                                </div>             
                            @endfor
                        @else
                            <div class="d-flex align-items-center">
                                <input class="form-control" type="text" name="requirements[]" placeholder="Nuevo requisito" id="req1" value="{{ old('requirements.0') }}">
                                <i id="first_req" class="bi bi-trash3-fill close mt-1" style="margin-left:5px;" class="btn-close" aria-label="Close"></i>
                            </div>
                        @endif

                    </div>
                    <button type="button" class="btn btn-primary my-2" onclick="addRequirement()"> {{ __('Añadir requisito') }} </button>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-4 m-auto my-2">
                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref"> {{ __('Prioridades de la oferta') }}: </label>
                    <select class="custom-select my-1 mr-sm-2 form-control" id="inlineFormCustomSelectPref" name="priority">
                        {{-- Improve --}}
                        @if ( $offer->priority == "Urgente" )
                            <option selected value="Urgente">{{  $offer->priority }}</option>
                            <option value="No Urgente"> {{ __('No Urgente') }} </option>
                        @elseif ( $offer->priority == "No Urgente" )
                            <option selected value="No Urgente">{{  $offer->priority }}</option>
                            <option value="Urgente"> {{ __('Urgente') }} </option>
                        @else
                            <option value="Urgente"> {{ __('Urgente') }} </option>
                            <option value="No urgente"> {{ __('No urgente') }} </option>
                        @endif
                    </select>
                </div>
                <div class="col-md-4 m-auto my-2">
                    <label for="vacant_positions">{{ __('Vacantes') }}:</label>
                    <input type="number" class="form-control" name="vacant_positions" id="3" value="{{ $offer->vacant_positions }}">

                    @error('vacant_positions')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror

                </div>
            </div>    
            {{-- SUBSCRIPTION DATES --}}
            <div class="row">
                <div class="col-md-4 m-auto my-2">
                    <label for="start"> {{ __('Data de inicio suscripción') }}: </label>
                    <input class="form-control col-2" type="datetime-local" id="dates" name="subscriptionStartDate" value="{{ $offer->subscriptionStartDate }}" min="2018-01-01" max="2030-12-31">

                    @error('subscriptionStartDate')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror

                </div>
                <div class="col-md-4 m-auto my-2">
                    <label for="start"> {{ __('Data final suscripción') }}: </label>
                    <input class="form-control" type="datetime-local" id="dates" name="subscriptionEndDate" value="{{ $offer->subscriptionEndDate }}" min="2018-01-01" max="2030-12-31">

                    @error('subscriptionEndDate')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror

                </div>
            </div>
            {{-- ACTIVITY DATES --}}
            <div class="row">
                <div class="col-md-4 m-auto my-2">
                    <label for="start"> {{ __('Data de inicio voluntariado') }}: </label>
                    <input class="form-control" type="datetime-local" id="dates" name="activityStartDate" value="{{ $offer->activityStartDate }}" min="2018-01-01" max="2030-12-31">
                </div>
                <div class="col-md-4 m-auto my-2">
                    <label for="start"> {{ __('Data final voluntariado') }}: </label>
                    <input class="form-control" type="datetime-local" id="dates" name="activityEndDate" value="{{ $offer->activityEndDate }}" min="2018-01-01" max="2030-12-31">
                </div>
            </div> 
            <div class="row">
                <div class="col-md-10 m-auto my-2">
                    <label for="description"> {{ __('Descripción') }} </label>
                    <textarea placeholder="{{ __('Introduce una descripción...') }}" class="form-control" name="description" id="4" rows="8" cols="33">{{ $offer->description }}</textarea>
                    
                    @error('description')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror

                </div>
            </div>
            <div class="row mt-2 mb-2">
                <div class="col-md-10 m-auto my-2">
                    <input type="file" name="image[]" class="form-control" multiple accept=".jpg, .jpeg, .png">
                    @error('image.*')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 m-auto my-2">
                    <button type="submit" class="text-white btn mt-2 btn-success btn-block col-3">{{  __('Actualizar') }}</button>
                </div>
            </div> 
        </div>
    </form>
    <div class="container">
        <div class="row" style="margin-top: 5%;">
            @for ( $index = 0; $index < count($offer->images); $index++)
                <div id="offer_images" class="col-md-6 col-xs-12">
                    <div style="width: 75%; box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2); margin-bottom:20px;" class="mydivouter">
                        <img class="my-2 w-100 image-hover" src="/images/offers/{{ $offer->images[$index]['image'] }}" alt="{{ $offer->images[$index]['image'] }}" style="height:auto;">
                        
                        @include("modals/delete_offer_image")
                        @include("modals/edit_offer_image")
                        <div class="mybuttonoverlap">
                            <a class="link" alt="Cambiar imagen">
                                <i class="bi bi-pencil-square" data-bs-toggle="modal" data-bs-target="#editOfferImageModel{{$index}}"></i>
                            </a>
                            <a class="link" data-bs-toggle="modal" data-bs-target="#deleteImageModel{{$index}}" alt="Eliminar imagen">
                                <i class="bi bi-trash3-fill"></i>
                            </a>
                        </div>

                        <!--<button type="button" class="mybuttonoverlap btn btn-danger"
                            data-bs-toggle="modal" data-bs-target="#deleteImageModel">{{ __('Eliminar')}}</button>-->
                    </div>
                </div>
            @endfor
        </div>
   </div>

@endsection