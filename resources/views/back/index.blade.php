@extends('layouts.master')

@section('content')
        <a href="{{route('post.create')}}" class="btn btn-success my-5">{{__('Create new post')}}</a>
    {{ $posts->links() }}
    <table class="table table-hover table-striped my-5">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">{{ __('Type') }}</th>
            <th scope="col">{{ __('Title') }}</th>
            <th scope="col" class="d-none d-md-table-cell">{{ __('Start date') }}</th>
            <th scope="col" class="d-none d-md-table-cell">{{ __('End date') }}</th>
            <th scope="col">{{ __('Status') }}</th>
            <th scope="col" class="text-center">{{ __('Actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($posts as $post)
            <tr class="clikable-row" data-href="{{route('show', $post->id)}}">
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->post_type }}</td>
                <td><a href="{{ route('show', $post->id) }}">{{ $post->title }}</a></td>
                <td class="d-none d-md-table-cell">{{ $post->start_date->format(__('Y-m-d')) }}</td>
                <td class="d-none d-md-table-cell">{{ $post->end_date->format(__('Y-m-d')) }}</td>
                <td>{{ $post->status }}</td>
                <td class="text-center">
                    <a href="{{route('post.edit', $post->id)}}"><i class="mx-2 fas fa-edit fa-lg edit-item"></i></a>
                    <a href="{{route('trash', $post->id)}}"><i class="mx-2 far fa-trash-alt fa-lg delete-item"></i></a>

                </td>
            </tr>
            @empty
            <p>Aucun enregistrements présents en base pour le moment.</p>
        @endforelse
        </tbody>
    </table>

    {{ $posts->links() }}

    <div class="my-5 trash-container">
        <a href="{{route('showTrash')}}"><i class="trash-store fas fa-trash-alt fa-8x"></i></a>
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
        $(document).on('click', '.clikable-row td:not(.text-center)', function() {
            window.location.href = $(this).parent('tr').data('href')
        })
        $(document).on('click', '.delete-item', function() {
            console.log($(this).data('post'));
        })
    </script>
@endsection