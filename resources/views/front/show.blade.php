@extends('layouts.master')

@section('content')
    <div class="back-button-container">
        @guest
            <a href="{{ route($backlink) }}" class="text-lime back-button mt2">{{ __('Back to') . ' ' . __($backlink)}}</a>
        @else
            <a href="{{ route('post.index') }}" class="text-lime back-button mt2">{{ __('Back to dashboard') }}</a>
         @endif
    </div>
    @if($post->status == "published" || Auth()->check())
        @include('front.partials.postCard')
    @else

        <div class="row center">
            <p class="col s12">
                {{ __('Oops... Seems like this post is not published yet') }}
            </p>
        </div>
    @endif
@endsection