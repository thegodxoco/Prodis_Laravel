@extends('layouts.app')

@section('title')
    <title> {{ __('Email') }} </title>
    <script defer src="{{ asset('js/emails.js') }}"></script>
@endsection

@section('content')
    <div class="row container-fluid mt-4">
        <div class="row">
            <div class="col">
                <form action="{{ route('emails.send') }}" method="POST">
                    @csrf
                    <div class="row mt-5">
                        <div class="col-md-6 col-xs-12 px-5">
                            <h3 class="pb-4">Envia email</h3>
                            <div class="mb-3 perfilForm">
                                <label class="form-label" for="from">{{ __('De') }}</label>
                                <input type="email" placeholder="" class="form-control" name="from" value="{{ env('MAIL_FROM_ADDRESS', 'test.prodis.laravel@gmail.com') }}" disabled>
                                @error('from')
                                    <p style="color:red;"> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3 perfilForm">
                                <label class="form-label" for="for">{{ __('Para') }} *</label>
                                <input type="email" class="form-control" name="for" value="">
                                <input type="checkbox" class="form-check-input" name="all_volunteers" value="check">
                                <label class="form-label" for="all_volunteers">{{ __('Para todos los voluntarios') }}</label>
                                @error('for')
                                    <p style="color:red;"> {{ $message }} </p>
                                @enderror
                            </div>

                        {{-- <div class="mb-3">
                            <label for="is_admin" class="form-label">{{ __('Admin') }}</label><br>
                            <input type="checkbox" class="form-check-input" name="is_admin" value="check"> {{--  no funciona OLD - -}}
                            {{-- @error('is_admin')
                                <p style="color:red;"> {{ $message }} </p>
                            @enderror --}}
                        {{-- </div> --}} 

                            <div class="mb-3 perfilForm">
                                <label class="form-label" for="subject">{{ __('Asunto') }}</label>
                                <input type="text" class="form-control" name="subject" value="">
                                @error('subject')
                                    <p style="color:red;"> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="mb-3 perfilForm">
                                <label class="form-label" for="content ">{{ __('Contenido') }}</label>
                                <textarea  class="form-control" name="content" id="4" rows="8" cols="33"></textarea>
                                @error('content')
                                    <p style="color:red;"> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-md-10 m-auto">
                                    {{ __('*: Campo obligatorio') }}
                                </div>
                            </div>
                            <div class="edit">
                                @include("modals/send_mail")
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sendMailModel">{{ __('Enviar') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
