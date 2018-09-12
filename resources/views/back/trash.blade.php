@extends('layouts.master')
@section('content')
    <div class="back-button-container">
        <a href="{{ route('post.index') }}" class="text-lime back-button mt2">{{ __('Back to dashboard') }}</a>
    </div>

    @if(count($posts) > 0)
    <table class="table mt2">
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
                        <i class="material-icons">undo</i>
                    </a>
                    <a class="btn-floating red delete-item">
                        <i class="material-icons">delete_forever</i>
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

        @if(Session::has('success'))
            swal('{{Session::get('success')}}');
        @endif

    </script>

@endsection

