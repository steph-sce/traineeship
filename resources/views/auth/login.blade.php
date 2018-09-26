@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 l8 offset-l2">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">{{ __('Login') }}</div>
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="email" class="active">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="validate {{ $errors->has('email') ? 'invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                @if($errors->has('email'))
                                    <span class="helper-text" data-error="{{ $errors->first('email') }}"></span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="validate {{ $errors->has('password') ? 'invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="helper-text" data-error="{{ $errors->first('password') }}"></span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s6 offset-s3">
                                <label class="" for="remember">
                                    <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                                    <span>{{ __('Remember Me') }}</span>
                                </label>
                            </div>
                        </div>

                        <div class="row center">
                            <div>
                                <button type="submit" class="form-mt btn lime darken-1 mt1">
                                    {{ __('Login') }}
                                </button>

                                <a class="form-mt btn lime darken-1 mt1" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            // this line is needed cause materialize automatically blur the field with autofocus
            $('#email').focus()
        })
    </script>

@endsection
