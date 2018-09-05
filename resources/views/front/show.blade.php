@extends('layouts.master')

@section('content')
    <div class="back-button-container">
        <a href="{{ route($backlink) }}" class="text-lime back-button mt2">{{ __('Back to') . ' ' . __($backlink)}}</a>
    </div>
    @include('front.partials.postCard')
@endsection