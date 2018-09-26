@extends('layouts.master')

@section('content')

    <div id="contact-infos" class="col m4 s12">
        <div id="contact-title">
            <p class="lime-text darken-1">{{ __('Contact us') }}</p>
        </div>
        <img src="{{ asset('img/logo_black.svg') }}" alt="">

        <div>
            <p class="bold">{{ __('E-Mail Address') }}: </p>
            <p>form@ction.com</p>
        </div>
        <div>
            <p class="bold">{{ __('Phone') }}: </p>
            <p>(+33)1 23 45 67 89</p>
        </div>
        <div id="social">
            <img  id="facebook" class="responsive-img col s2 m3" src="{{ asset('img/icon-facebook.png') }}" alt="logofacebook">
            <img  id="google" class="responsive-img col s2 m3" src="{{ asset('img/icon-googleplus.png') }}" alt="logogoogle">
            <img  id="linkedin" class="responsive-img col s2 m3" src="{{ asset('img/icon-linkedin.png') }}" alt="logolinkedin">
        </div>
    </div>

    <form class="mt2 col s12 m8" id="contact-form" action="{{ route('sendContactMail') }}" method="POST">
        @csrf
        <div class="row">
            <div class="input-field col s12">
                <input name="email" id="email" type="email" class="validate" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required autofocus>
                <label class="active" for="email">{{ __('E-Mail Address') }}</label>
                @if(Session::has('errors'))
                    <span class="helper-text" data-error="{{ $errors->first('email') }}"></span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <textarea class="materialize-textarea" name="message" id="message" placeholder="{{ __('Type your message...') }}" required>{{ old('message') }}</textarea>
                <label class="active" for="message">{{ __('Your message') }}</label>
                @if(Session::has('errors'))
                    <span class="helper-text" data-error="{{ $errors->first('message') }}"></span>
                @endif
            </div>
        </div>
        <div class="center">
            <button class="waves-effect waves-light btn lime darken-1" type="submit">{{ __('Submit') }}</button>
        </div>
    </form>
@endsection


@section('scripts')
    @parent
    @if(Session::has('errors'))
        <script type="text/javascript">
            @if($errors->first('email') != '')
                $('#email').addClass('invalid');
            @endif
            @if($errors->first('message')!= '')
                $('#message').addClass('invalid');
            @endif
        </script>
    @endif
    @if(Session::has('message'))
        <script type="text/javascript">
            const output = swal.mixin({
                type : "success",
                title : '{{ Session::get('message') }}'
            })

            output({
                confirmButtonColor : "#c0ca33"
            })
        </script>
    @endif

@endsection