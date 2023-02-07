@extends('layouts.app')

@section('title')
    <title> {{ $offer->name }} </title>
@endsection
 
@section('content')

    <div class="container my-5">
        @if (Auth::check())
            @if (Auth::user()->admin)
                <div id="admin_menu" class="d-flex">
                    <form action="/offer/edit/{{$offer->id}}" method="GET">
                        @csrf
                        <input class="btn btn-secondary my-3" type="submit" value="Modificar" />
                    </form>
                    
                    @include("modals/delete_offer")
                    <button type="button" class="btn btn-danger my-3 mx-4" data-bs-toggle="modal" data-bs-target="#deleteOfferModel">Eliminar</button>

                    <a href="{{ route('reports.offer_volunteers', ['offer_id' => $offer->id]) }}"><button class="btn btn-primary my-3" type="button">{{ __("Informe de voluntarios (PDF)") }}</button></a> 
                </div>
            @endif
        @endif
        
        <div class="row justify-content-start">
            <div class="col-md-6 col-xs-12">
                <div id="details">
                    @if ($offer->priority === 'Urgente')
                        <h3 class="my-3">{{ $offer->title }} &emsp; <span class="badge alert-danger badge" style="margin-top: -5px;">{{ __('Urgente') }}</span></h3>                        
                    @else
                        <h3 class="my-3">{{ $offer->title }}</h3>
                    @endif
                    <ul id="offer_details" class="list row" style="list-style: none;">
                        <li class="col-6"> <b>{{ __('Dirección') }}</b>: {{ $offer->address }} </li>
                        <li class="col-6"> <b>{{ __('Provincia') }}</b>: {{ $offer->province }} </li>
                        <li class="col-6"> <b>{{ __('Ciudad') }}</b>: {{ $offer->city }} </li>
                        <li class="col-6"> <b>{{ __('Código postal') }}</b>: {{ $offer->zip_code }} </li>
                        <li class="col-6"> <b>{{ __('Vacantes') }}</b>: {{ $offer->vacant_positions }} </li>
                        <li class="col-6"> <b>{{ __('Publicada') }}</b>: {{ $offer->created_at }} </li>
                    </ul>
                    <p>
                        @foreach ($offer->categories as $category)
                            <span class="badge alert-success badge">{{ $category->name }}</span>
                        @endforeach
                    </p>
                </div>
                <hr>
                <div id="dates">
                    <h3 class="my-2"> {{ __("Fechas de la actividad") }} </h3>
                    <ul class="list row" style="list-style: none;">
                        <li class="list-item col-6"><b>{{ __('Inicio de la inscripción') }}</b>: <br>{{ $offer->subscriptionStartDate }}</li>
                        <li class="list-item col-6"><b>{{ __('Final de la inscripción') }}</b>: <br>{{ $offer->subscriptionEndDate }}</li>
                    </ul>
                    <hr>
                    <ul class="list row" style="list-style: none;">
                        <li class="list-item col-6"><b>{{ __('Inicio de la actividad') }}</b>: <br>{{ $offer->activityStartDate }}</li>
                        <li class="list-item col-6"><b>{{ __('Final de la actividad') }}</b>: <br>{{ $offer->activityEndDate }}</li>
                    </ul>
                </div>
                <hr>
                <div id="requiremets" class="my-2">
                    <h3> {{ __("Requisitos") }} </h3>
                    <ul id="offer_requirements" class="list row">
                        @foreach ( $offer->requirements as $key => $value )
                            @if ($value != null)
                                <li class="list-item col-6">{{$value}}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div style="width: 80%;">
                    @if ( count($offer->images)  )
                        <img class="w-100" src="/images/offers/{{ $offer->images[0]['image'] }}" alt="{{ $offer->images[0]['image'] }}" style="height:auto;">
                    @else
                        <img class="my-3 w-100" src="/images/offer_pic.png" alt="main image" style="height:auto;">
                    @endif
                </div>
            </div>
        </div>
        <hr>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-6 col-xs-12">
                <h3> {{ __('Descripción de la oferta') }} </h3>
            </div>
            <div class="col-md-6 col-xs-12 justify-content-end">
                @include('partials/days_left')

                @if ($isSubscribed)
                    @include("modals/unsubscribe_offer")
                    <button type="button" class="btn btn-danger my-3" data-bs-toggle="modal" data-bs-target="#unsubscribeToOfferModel">{{ __('Desuscribir') }}</button>         
                @else
                    @guest
                        <a href="{{ url('/login') }}"><button class="bg-success text-white btn my-3" type="button">{{ __('Inscribirme en la oferta') }}</button></a>
                    @endguest
                    
                    @auth
                        @if ( $offer->subscribable)
                            @include("modals/subscribe_offer")
                            <button type="button" class="btn-success text-white btn my-3" data-bs-toggle="modal" data-bs-target="#subscribeToOfferModel">{{ __('Inscribirme en la oferta') }}</button>
                        @else
                            <div class="align-self-end alert alert-danger p-2 subscription" role="alert">
                                {{ __("No te puedes suscribir") }}
                                <span><i class="fa-solid fa-pen"></i></span>
                            </div>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
        <p style="word-break: break-all;">{{ $offer->description }}</p>
        <div class="row" style="margin-top: 5%;">
            @for ( $index = 1; $index < count($offer->images); $index++)
                <div class="col-md-6 col-xs-12">
                    <div style="width: 75%;">
                        <img class="image-hover my-3 w-100" src="/images/offers/{{ $offer->images[$index]['image'] }}" alt="{{ $offer->images[$index]['image'] }}" style="height:auto;">
                        
                    </div>
                </div>
            @endfor
        </div> 
    </div>

@endsection