<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informe</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Niramit:ital,wght@0,300;0,700;1,600&family=Nunito&display=swap" rel="stylesheet">

    <!-- Styles -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootsrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<style>
    body {
        font-family: 'Nunito', 'Niramit' !important;
    }

    .flex-item {
        justify-content: space-between;
    }
</style>
<body class="m-4">
    <div class="row">
        <img class="text-start col-6" src="{{ public_path('images/logo-prodis.png') }}" alt="Logo de prodis" style="width: 15%;">
        <p class="text-end col-6" style="font-size:10px;">{{ Carbon\Carbon::now(); }}</p>
    </div>
    <hr>
    <div class="row">
        <p class="text-center col-12">{{ __('Informe de voluntarios en la oferta ') . $offer->title }}</p>
    </div>
    

    <div class="mt-2">
        <div style="margin-top: 5%;" class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('Nombre') }}</th>
                        <th>{{ __('Primer apellido') }}</th>
                        <th>{{ __('Segundo apellido') }}</th>
                        <th>{{ __('Correo electrónico') }}</th>
                        <th>{{ __('Número de teléfono') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($volunteers as $volunteer)
                        <tr>
                            <td>{{ $volunteer->name }}</td>
                            <td>{{ $volunteer->surname1 }}</td>
                            <td>{{ $volunteer->surname2 }}</td>
                            <td>{{ $volunteer->email }}</td>
                            <td>{{ $volunteer->phone }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>