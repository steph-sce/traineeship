@extends('layouts.master')

@section('content')

    <h2 class="text-center">Ici le contenu principal</h2>

    @forelse($posts as $post)
        @include('front.partials.postCard')
    @empty
        Aucune formation n'est encore mise en ligne
    @endforelse

@endsection