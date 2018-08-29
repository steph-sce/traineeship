@extends('layouts.master')

@section('content')
    <a href="{{ route('index') }}" class="btn btn-info">{{ __('<< Back') . ' à l\'accueil' }}</a>

    @include('front.partials.postCard', ['show' => true])

@endsection