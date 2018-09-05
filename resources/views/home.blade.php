@extends('layouts.master')

@section('content')
<div class="container">
    <div class="mt2 row center">
        <div class="col s12 m8">
            <div class="card">
                <div class="card-header"><a class="lime-text" href="{{ route('post.index') }}">{{ __('Dashboard') }}</a></div>

                <div class="card-content">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>{{ __('You are logged in!') }}</p>
                    <p class="mt-2">Bienvenue {{Auth::user()->name}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
