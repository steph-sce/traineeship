@extends('layouts.master')

@section('content')
    <a href="{{ route('index') }}" class="btn btn-info">{{ __('<< Home') }}</a>

    @include('front.partials.postCard')

@endsection