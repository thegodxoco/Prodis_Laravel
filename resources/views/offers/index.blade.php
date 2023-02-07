@extends('layouts.app')

@section('title')
    <title> {{ __('Ofertas') }} </title>
@endsection

@section('content')
    <section style="background-image: url('/images/all_offers_banner.jpeg');background-size: cover;" class="section p-5 mb-5">
        <div class="d-flex flex-column justify-content-center align-items-center ">
            
            <div class="d-flex flex-row container-md w-50 p-5 mb-4 justify-content-center align-items-center text-center"
                style="background-color: #eee;">
                <p class="text-wrap" style="font-size: 5vw;">{{ __('Ofertas de voluntariados') }}</p>
            </div>
           
            <div class="d-flex flex-row container-md w-50 p-1 justify-content-center align-items-center text-center"
                style="background-color: #eee;">
                <p class="text-wrap" style="margin: 0 !important;">{{ __('Entre todos construimos Prodis') }}</p>
            </div>
        </div>
    </section>

    @if (session()->has('success'))
        <div class="alert alert-success alert-block" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex flex-column align-items-center">
        <h1>{{ __('Listado de ofertas') }}</h1>

        @foreach ($offers as $offer)
            <div class="card my-3 w-75" style="background-color: hsl(165, 17%, 95%); color:rgb(77, 81, 83);">
                <div class="row g-0">
                    <div class="col-md-4">
                        @if ( count($offer->images)  )
                            <img class="w-100" src="/images/offers/{{ $offer->images[0]['image'] }}" alt="{{ $offer->images[0]['image'] }}" style="height:auto;">
                        @else
                            <img class="my-3 w-100" src="/images/offer_pic.png" alt="main image" style="height:auto;">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">

                            <div class="pt-3 d-flex justify-content-between">
                                <a style="text-decoration: none; color: black;" href="{{ route("offer.show", ['id' => $offer->id]) }}"><h2 class="card-title d-flex flex-column w-100">{{ $offer->title }}</h2></a>
                                <div class="d-flex flex-column flex-shrink-1">
                                    @auth
                                        @if ($offer->users->where('id', Auth::user()->id)->first() )
                                            <span class="alert alert-success p-2" style="font-size: 18px;">
                                                <i class="bi bi-check-circle-fill"></i>&emsp;{{ __('Ya estás suscrito') }}
                                            </span>
                                        @else
                                            @include('partials/days_left')
                                        @endif
                                    @endauth
                                    @guest
                                        @include('partials/days_left') 
                                    @endguest
                                </div>
                            </div>

                            <div class="card-text">
                                @foreach ($offer->categories()->get() as $category)
                                    <a style="text-decoration: none;" href="/offers/{{ $category->name }}"
                                        class="mb-3 badge alert-success badge">{{ $category->name }}</a>
                                @endforeach
                            </div>
                            <p class="card-text">{{ substr($offer->description, 0, 200) }}</p>
                            <p class="card-text"><a href="/offer/{{ $offer->id }}">{{ __('Leer más...') }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div>
            {{ $offers->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection