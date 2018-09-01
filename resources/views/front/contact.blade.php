@extends('layouts.master')

@section('content')

    <form class="col s6 offset-s3" id="contact-form" action="{{ route('sendContactMail') }}" method="POST">
        @csrf
        <div class="row">
            <div class="input-field col s12">
                <input name="email" id="email" type="email" class="validate" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required>
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
        <input type="submit" class="btn lime" value="{{ __('Submit') }}">
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
            alert('{{Session::get('message')}}');
        </script>
    @endif

@endsection