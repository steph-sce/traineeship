<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plateforme d'apprentissage</title>
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    {{--<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">--}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.10/dist/sweetalert2.min.css">
</head>

<body>
<div id="app">
    <header>
        <div class="header-bg valign-wrapper center">
            <img class="header-logo center-align" src="{{asset('img/logo.svg')}}" alt="">
        </div>
    </header>


    @include('partials.menu')
    <main class="row container">
        {{--<div class="col s12">
            @includeWhen($sidebar, 'partials.sidebar')
        </div>--}}
        <div class="col s12">
            @yield('content')
        </div>
        {{--include conditionnel    si le partial existe il s'inclue sinon rien ne se passe (pas d'erreur)    include conditionnel--}}
        {{--<div class="col s4">
            @includeWhen($sidebar, 'partials.sidebar')
        </div>--}}
    </main>



    <div class="footer-wrapper row">
        <footer class="col s12">
            <div class="valign-wrapper col s12">
                <p class="col s8 right">© <a target="_blank" href="http://julienjovy.free.fr">Julien Jovy</a> - En partenariat avec</p>
                <img class="" src="{{ asset('/img/lecolemultilogo.png') }}" alt="">
            </div>
        </footer>


    </div>
</div>


@section('scripts')

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.10/dist/sweetalert2.all.min.js"></script>
    <script>
        $(window).on('resize', function(e) {
            console.log($(window).height());
            var footerPos = $(window).height();
            footer.css('top', footerPos + "px");
        })
        $(document).ready(function(){
            var footer = $('footer');
            var footerHeight = Number(footer.css('height').replace('px', ''));
            console.log(footerHeight);
            var footerPos = $(document).height() - footerHeight;

            footer.css('position', 'absolute').css('width', '100%').css('top', footerPos + "px");
            footer.fadeTo("slow", 1);
            $('.sidenav').sidenav();
        });

        $('.close').on('click', function() {
            $('#search').val('');
        })
    </script>
    @show


</body>
</html>