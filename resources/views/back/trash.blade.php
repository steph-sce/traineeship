@extends('layouts.master')

@section('content')
    <a href="{{ route('post.index') }}" class="btn btn-info">{{ __('<< Back to dashboard') }}</a>

    @if(count($posts) > 0)
    <table class="table my-5">
        <thead>
            <tr>
                <td scope="col">Id</td>
                <td scope="col">{{ __('Type') }}</td>
                <td scope="col">{{ __('Title') }}</td>
                <td scope="col" class="hide-on-small-only">{{ __('Start date') }}</td>
                <td scope="col" class="hide-on-small-only">{{ __('End date') }}</td>
                <td scope="col" class="center">{{ __('Actions') }}</td>
            </tr>
        </thead>
        <tbody>
        @forelse($posts as $post)
            <tr data-href="{{ route('show', $post) }}">
                <td>{{ $post->id }}</td>
                <td>{{ $post->post_type }}</td>
                <td><a href="{{ route('show', $post) }}">{{ $post->title }}</a></td>
                <td class="hide-on-small-only">{{ $post->start_date->format(__('Y-m-d')) }}</td>
                <td class="hide-on-small-only">{{ $post->end_date->format(__('Y-m-d')) }}</td>
                <td class="center">
                    <a class="btn-floating" href="{{ route('draft', $post) }}">
                        <i class="large material-icons">undo</i>
                    </a>
                    <a class="btn-floating red btn-large delete-item">
                        <i class="large material-icons">delete_forever</i>
                    </a>
                    <form action="{{ route('post.destroy', $post) }}" method="post" class="hide">
                        @csrf
                        @method('delete')
                    </form>
                </td>
            </tr>
            @empty
                    <tr>
                        <td>{{ __('No records are flagged as trashed') }}</td>
                    </tr>
            @endforelse
        </tbody>
    </table>
    @else
        <div class="row center">
            <p class="col s12">
                {{ __('No records are flagged as trashed') }}
            </p>
        </div>
    @endif


@endsection

@section('scripts')
    @parent
    <script>
        $('.delete-item').on('click', function(e) {
            e.preventDefault();
            $(this).next('form').submit();
            console.log($(this).next('form'));
        })

    </script>

@endsection

