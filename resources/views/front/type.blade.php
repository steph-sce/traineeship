@extends('layouts.master')

@section('content')

    {{$posts->links()}}

    @forelse($posts as $post)
        @include('front.partials.postCard')
    @empty
        Aucune formation correspondante au filtre selectionné n'a été publiée
    @endforelse


    {{$posts->links()}}
@endsection