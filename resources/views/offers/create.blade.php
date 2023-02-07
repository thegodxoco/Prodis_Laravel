@extends('layouts.app')

@section('title')
    <title> {{  __('Crear oferta') }} </title>
    <script defer src="{{ asset('js/offer.js') }}"></script>
@endsection

@section('content') 

    <style>
        .close:hover{
            color:rgb(107, 107, 107);
        }
    </style>

    <form action="{{ route('offers.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container my-5">
            <div class="row">
                <h1 class="mb-5">Crear oferta</h1>
                <div class="col-md-4 m-auto my-2">
                    <label for="title"> {{ __('Título') }} * </label>
                    <input type="text" class="form-control" name="title" placeholder="{{ __('Título') }}" value="{{ old('title') }}">

                    @error('title')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror

                </div>
                <div class="col-md-4 m-auto my-2">
                    <label for="address"> {{ __('Dirección') }} * </label>
                    <input type="text" class="form-control" name="address" placeholder="{{ __('Dirección') }}" value="{{ old('address') }}">

                    @error('address')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror

                </div>
            </div>
        
            <div class="row">
                <div class="col-md-4 m-auto my-2">
                    <label for="city"> {{ __('Ciudad') }} * </label>
                    <input type="text" class="form-control" name="city" placeholder="{{ __('Ciudad') }}" id="ciudad" value="{{ old('city') }}">

                    @error('city')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror

                </div>
                <div class="col-md-4 m-auto my-2">
                    <label for="province"> {{ __('Provincia') }} * </label>
                    
                    <select id="province" name="province" class="form-control"> 
                    <option selected>{{ old('province') }}</option>
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
                    <input type="number" class="form-control" name="zip_code" placeholder= "{{ __('Código postal') }}" id="zip_code" value="{{ old('zip_code') }}">

                    @error('zip_code')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror

                </div>
                <div class="col-md-4 m-auto my-2"></div>
            </div>

            <div class="row">
                <div class="col-md-4 m-auto my-2">
                    <div class="d-flex flex-column" id="categories">
                        <label for="inputCategory"> {{ __('Elige categoría/s') }}</label>

                        <select class="col-md-4" name="selected_categories[]" id="select_categories" multiple style="width: 200px;height: 150px;">
                                                        
                            @foreach ( $categories as $category )
                                @if (old('selected_categories'))
                                    
                                    @if (in_array($category->name, old('selected_categories')))
                                        <option selected value="{{ $category->name }}">{{ $category->name}}</option>
                                    @else
                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                    @endif
                                @else
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @endif
                            @endforeach

                        </select>
                        <p>{{ __('Para seleccionar más de una categoría, mantén presionado la tecla Ctrl.') }}</p>
                    </div>
                </div>
                <div class="col-md-4 m-auto my-2">
                    <div id="requirements">
                        <label for="requirements[]"> {{ __('Requisitos') }} </label>

                        @if(old('requirements'))
                            @for( $i =0; $i < count(old('requirements')); $i++)
                                <div class="d-flex align-items-center">
                                    <input type="text" value="{{ old('requirements.'.$i)}}"  name="requirements[]" class="form-control mt-2" />
                                    <i id="first_req" class="bi bi-trash3-fill close" class="btn-close" aria-label="Close"></i>
                                </div>                                   
                            @endfor
                        @else
                            <div class="d-flex align-items-center">
                                <input class="form-control" type="text" name="requirements[]" placeholder="{{ __('Nuevo requisito') }}" id="req1" value="{{ old('requirements.0') }}">
                                <i id="first_req" class="bi bi-trash3-fill close mt-1" style="margin-left:5px;" class="btn-close" aria-label="Close"></i>
                            </div>
                        @endif

                    </div>
                    @error('requirements.*')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror
                    @error('requirements')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror
                    <button type="button" class="btn btn-primary my-2" onclick="addRequirement()"> {{ __('Añadir requisito') }} </button>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-4 m-auto my-2">
                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref"> {{ __('Prioridades de la oferta') }} </label>
                    <select class="custom-select my-1 mr-sm-2 form-control" id="inlineFormCustomSelectPref" name="priority">
                        <option value="Urgente">{{ __('Urgente') }}</option>
                        <option selected value="No urgente">{{ __('No urgente') }}</option>
                    </select>
                </div>
                <div class="col-md-4 m-auto my-2">
                    <label for="vacant_positions">{{ __('Vacantes') }} *</label>
                    <input type="number" class="form-control" placeholder="{{ __('Introduce un número de vacantes') }}" name="vacant_positions" id="3" value="{{ old('vacant_positions') }}">

                    @error('vacant_positions')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror

                </div>
            </div>
            
            {{-- SUBSCRIPTION DATES --}}
            <div class="row">
                <div class="col-md-4 m-auto my-2">
                    <label for="start"> {{ __('Data de inicio suscripción') }} * </label>
                    <input class="form-control col-2" type="datetime-local" id="dates" name="subscriptionStartDate" value="{{ old('subscriptionStartDate') }}" min="2018-01-01" max="2030-12-31">

                    @error('subscriptionStartDate')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror

                </div>
                <div class="col-md-4 m-auto my-2">
                    <label for="start"> {{ __('Data final suscripción') }} * </label>
                    <input class="form-control" type="datetime-local" id="dates" name="subscriptionEndDate" value="{{ old('subscriptionEndDate') }}" min="2018-01-01" max="2030-12-31">

                    @error('subscriptionEndDate')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror

                </div>
            </div>
            {{-- ACTIVITY DATES --}}
            <div class="row">
                <div class="col-md-4 m-auto my-2">
                    <label for="start"> {{ __('Data de inicio voluntariado') }} </label>
                    <input class="form-control" type="datetime-local" id="dates" name="activityStartDate" value="{{ old('activityStartDate') }}" min="2018-01-01" max="2030-12-31">
                    @error('activityStartDate')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror
                </div>
                <div class="col-md-4 m-auto my-2">
                    <label for="start"> {{ __('Data final voluntariado') }} </label>
                    <input class="form-control" type="datetime-local" id="dates" name="activityEndDate" value="{{ old('activityEndDate') }}" min="2018-01-01" max="2030-12-31">
                    @error('activityEndDate')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror
                </div>
            </div> 

            <div class="row">
                <div class="col-md-10 m-auto my-2">
                    <label for="description"> {{ __('Descripción') }} </label>
                    <textarea placeholder="{{ __('Introduce una descripción...') }}" value="" class="form-control" name="description" id="4" rows="8" cols="33">{{ old('description') }}</textarea>
                    
                    @error('description')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror

                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-10 m-auto my-2">
                    <input type="file" name="image[]" class="form-control" multiple accept=".jpg, .jpeg, .png">
                    @error('image')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror
                    @error('image.*')
                        <p style="color:red;"> {{$message}} </p>
                    @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-10 m-auto">
                    {{ __('*: Campo obligatorio') }}
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 m-auto my-2">
                    @include("modals/create_offer")
                    <button type="button" class="btn btn-block col-3 text-white btn-success" data-bs-toggle="modal" data-bs-target="#createOfferModel">{{ __('Crea') }}</button>
                </div>
            </div>
            
        </div>
    </form>

@endsection