@extends('layouts.master')

@section('content')
    <a href="{{ route('post.index') }}" class="btn btn-info">{{ __('<< Back to dashboard') }}</a>

    <table class="table my-5">
        <thead>
            <tr>
                <td scope="col">Id</td>
                <td scope="col">{{ __('Type') }}</td>
                <td scope="col">{{ __('Title') }}</td>
                <td scope="col">{{ __('Start date') }}</td>
                <td scope="col">{{ __('End date') }}</td>
                <td scope="col">{{ __('Actions') }}</td>
            </tr>
        </thead>
        <tbody>
        @forelse($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->post_type }}</td>
                <td><a href="{{ route('show', $post->id) }}">{{ $post->title }}</a></td>
                <td>{{ $post->start_date->format(__('Y-m-d')) }}</td>
                <td>{{ $post->end_date->format(__('Y-m-d')) }}</td>
                <td>FAB</td>
            </tr>
            @empty
                    <tr>
                        <td>{{ __('No records are flagged as trashed') }}</td>
                    </tr>
            @endforelse
        </tbody>
    </table>


@endsection

