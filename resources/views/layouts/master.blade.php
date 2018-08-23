<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plateforme d'apprentissage</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.10/dist/sweetalert2.min.css">
</head>

<body>

<div class="container-fluid">
    @include('partials.menu')
    <main class="row">
        <div class="col-md-8">
            @yield('content')
        </div>
        <div class="col-md-4">
            {{--  include conditionnel    si le partial existe il s'inclue sinon rien ne se passe (pas d'erreur)    include conditionnel --}}
            @includeIf('partials.sidebar')
        </div>
    </main>
</div>


@section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.10/dist/sweetalert2.all.min.js"></script>
</body>
</html>