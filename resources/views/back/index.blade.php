@extends('layouts.master')

@section('content')
        <a href="{{route('post.create')}}" class="btn lime darken-1">{{__('Create new post')}}</a>
    {{ $posts->links() }}
    <table class="highlight">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">{{ __('Type') }}</th>
            <th scope="col">{{ __('Title') }}</th>
            <th scope="col" class="hide-on-small-only">{{ __('Start date') }}</th>
            <th scope="col" class="hide-on-small-only">{{ __('End date') }}</th>
            <th scope="col">{{ __('Status') }}</th>
            <th scope="col" class="center">{{ __('Actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($posts as $post)
            <tr class="clikable-row" data-href="{{route('show', $post->id)}}">
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->post_type }}</td>
                <td><a href="{{ route('show', $post->id) }}">{{ $post->title }}</a></td>
                <td class="hide-on-small-only">{{ $post->start_date->format(__('Y-m-d')) }}</td>
                <td class="hide-on-small-only">{{ $post->end_date->format(__('Y-m-d')) }}</td>
                <td>{{ $post->status }}</td>
                <td class="center">
                    <a href="{{ route('post.edit', $post) }}" class="btn action-button hide-on-med-and-down"><i class="material-icons">edit</i>{{ __('Edit') }}</a>
                    <a href="{{ route('trash', $post) }}" class="btn red action-button hide-on-med-and-down"><i class="material-icons">delete_forever</i> {{ __('Trash') }}</a>
                    <a href="{{ route('post.edit', $post) }}" class="btn-floating btn action-button show-on-medium-and-down hide-on-large-only mt1"><i class="material-icons">edit</i></a>
                    <a href="{{ route('trash', $post) }}" class="btn-floating btn red action-button show-on-medium-and-down hide-on-large-only mt1"><i class="material-icons">delete_forever</i></a>

                </td>
            </tr>
            @empty
            <p>Aucun enregistrements présents en base pour le moment.</p>
        @endforelse
        </tbody>
    </table>

    {{ $posts->links() }}

        <div class="fixed-action-btn hide-on-med-and-down">
            <a href="{{ route('showTrash') }}" class="btn-floating btn-large red">
                <i class="material-icons">delete</i>
            </a>
        </div>

@endsection

@section('scripts')
    @parent
    @if(Session::has('success'))
        <script>
            alert('{{Session::get('success')}}');
        </script>
    @endif
    <script>
        $(document).on('click', '.clikable-row td:not(.center)', function() {
            window.location.href = $(this).parent('tr').data('href')
        })
        $(document).on('click', '.delete-item', function() {
            console.log($(this).data('post'));
        })
    </script>
@endsection