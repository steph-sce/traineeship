@extends('layouts.master')

@section('content')
    <a href="{{ route('post.index') }}" class="btn btn-info">{{ __('<< Back to dashboard') }}</a>
    <form class="col-12 offset-sm-2 col-sm-8 my-5" action="{{route('post.update', $post->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="title">{{ __('Title') . ": " }}</label>
            <input class="form-control" type="text" name="title" id="title" placeholder="{{ __('Title') }}" value="{{ old('title', $post->title) }}">
            @if($errors->has('title'))
                <div class="alert alert-danger mt-1">{{$errors->first('title')}}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="description">{{ __('Description') . ": " }}</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ old('description', $post->description) }}</textarea>
            @if($errors->has('description'))
                <div class="alert alert-danger mt-1">{{$errors->first('description')}}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="post_type">{{ __('Post type') . ": " }}</label>
            <select class="form-control" name="post_type" id="post_type">
                <option value="">{{ __('Select post type') }}</option>
                <option value="stage" {{ old('post_type', strtolower($post->post_type)) === 'stage' ? "selected" : ""  }}>Stage</option>
                <option value="formation" {{ old('post_type', strtolower($post->post_type)) === 'formation' ? "selected" : "" }}>Formation</option>
            </select>
            @if($errors->has('post_type'))
                <div class="alert alert-danger mt-1">{{$errors->first('post_type')}}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="start_date">{{ __('Start date') . ": " }}</label>
            <input class="form-control" type="date" name="start_date" id="start_date" value="{{ old('start_date', $post->start_date->format('Y-m-d')) }}">
            @if($errors->has('start_date'))
                <div class="alert alert-danger mt-1">{{$errors->first('start_date')}}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="end_date">{{ __('End date') . ": " }}</label>
            <input class="form-control" type="date" name="end_date" id="end_date" value="{{ old('end_date', $post->end_date->format('Y-m-d')) }}">
            @if($errors->has('end_date'))
                    <div class="alert alert-danger mt-1">{{$errors->first('end_date')}}</div>
        @endif
        </div>

        <div class="form-group">
            <label for="price">{{ __('Price') . ": " }}</label>
            <input type="number" class="form-control" min="0" max="99999.99" step="0.01" name="price" id="price" value="{{ old('price', $post->price) }}">
            @if($errors->has('price'))
                <div class="alert alert-danger mt-1">{{$errors->first('price')}}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="max_students">{{ __('Max students') . ": " }}</label>
            <input type="number" class="form-control" min="0" max="65535" step="1" name="max_students" id="max_students" value="{{ old('max_students', $post->max_students) }}">
            @if($errors->has('max_students'))
                <div class="alert alert-danger mt-1">{{$errors->first('max_students')}}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="status">{{ __('Status') .": " }}</label>
            <select name="status" id="status" class="form-control">
                <option value="draft" {{ old('status', $post->status) === "draft" ? "selected" : "" }}>{{ __('Draft')}}</option>
                <option value="published" {{ old('status', $post->status) === "published" ? "selected" : "" }}>{{ __('Published') }}</option>
            </select>
            @if($errors->has('status'))
                <div class="alert alert-danger mt-1">{{$errors->first('status')}}</div>
            @endif
        </div>


        <div class="form-group">
            <label for="picture">{{ __('Picture') .": " }}</label>
            <input class="form-control" type="file" name="picture" id="picture">
            @if(count($post->picture) > 0)
                <div class="mt-3">

                </div>
                <p class="alert alert-info">{{ __('Saved picture') }}</p>
                <img src="{{ asset('images/' .$post->picture->link) }}" alt="">
            @endif
        </div>

        <div class="form-group"><input type="submit" class="form-control btn btn-success my-2" value="{{ __('Submit') }}"></div>
    </form>

@endsection