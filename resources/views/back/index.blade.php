@extends('layouts.master')



{{-- @TODO implémenter la <table> pour afficher la liste des posts administrables --}}

@section('content')
        <a href="{{route('post.create')}}" class="btn btn-success my-5">{{__('Create new post')}}</a>
    {{ $posts->links() }}
    <table class="table table-hover table-striped my-5">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">{{ __('Type') }}</th>
            <th scope="col">{{ __('Title') }}</th>
            <th scope="col">{{ __('Start date') }}</th>
            <th scope="col">{{ __('End date') }}</th>
            <th scope="col">{{ __('Status') }}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($posts as $post)
            <tr class="clikable-row" data-href="{{route('show', $post->id)}}">
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->post_type }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->start_date->format(__('Y-m-d')) }}</td>
                <td>{{ $post->end_date->format(__('Y-m-d')) }}</td>
                <td>{{ $post->status }}</td>
            </tr>
            @empty
            <p>Aucun enregistrements présents en base pour le moment.</p>
        @endforelse
        </tbody>
    </table>

    {{ $posts->links() }}

@endsection

@section('scripts')
    @parent
    <script>
        $(document).on('click', '.clikable-row', function() {
            window.location.href = $(this).data('href')
        })
    </script>
@endsection