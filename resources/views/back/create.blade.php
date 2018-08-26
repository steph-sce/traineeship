@extends('layouts.master')

@section('content')
    <form class="col-12 offset-sm-2 col-sm-8 my-5" action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        
        {{-- (div.form-group>label+input.form-control)*8 --}}

        <div class="form-group">
            <label for="title">{{ __('Title') . ": " }}</label>
            <input class="form-control" type="text" name="title" id="title" placeholder="{{ __('Title') }}" value="{{old('title')}}">
            @if($errors->has('title'))
                <div class="alert alert-danger mt-1">{{$errors->first('title')}}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="description">{{ __('Description') . ": " }}</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
            @if($errors->has('description'))
                <div class="alert alert-danger mt-1">{{$errors->first('description')}}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="post_type">{{ __('Post type') . ": " }}</label>
            <select class="form-control" name="post_type" id="post_type">
                <option value="">{{ __('Select post type') }}</option>
                <option value="stage">Stage</option>
                <option value="formation">Formation</option>
            </select>
            @if($errors->has('post_type'))
                <div class="alert alert-danger mt-1">{{$errors->first('post_type')}}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="start_date">{{ __('Start date') . ": " }}</label>
            <input class="form-control" type="date" name="start_date" id="start_date">
            @if($errors->has('start_date'))
                <div class="alert alert-danger mt-1">{{$errors->first('start_date')}}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="end_date">{{ __('End date') . ": " }}</label>
            <input class="form-control" type="date" name="end_date" id="end_date">
            @if($errors->has('end_date'))
                <div class="alert alert-danger mt-1">{{$errors->first('end_date')}}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="price">{{ __('Price') . ": " }}</label>
            <input type="number" class="form-control" min="0" max="99999.99" step="0.01" name="price" id="price">
            @if($errors->has('price'))
                <div class="alert alert-danger mt-1">{{$errors->first('price')}}</div>
            @endif
        </div>

        <div class="form-group">
            <label for="max_students">{{ __('Max students') . ": " }}</label>
            <input type="number" class="form-control" min="0" max="65535" step="1" name="max_students" id="max_students">
            @if($errors->has('max_students'))
                <div class="alert alert-danger mt-1">{{$errors->first('max_students')}}</div>
            @endif
        </div>
        
        <div class="form-group">
            <label for="status">{{ __('Status') .": " }}</label>
            <select name="status" id="status" class="form-control">
                <option value="draft">{{ __('Draft')}}</option>
                <option value="published">{{ __('Published') }}</option>
            </select>
            @if($errors->has('status'))
                <div class="alert alert-danger mt-1">{{$errors->first('status')}}</div>
            @endif
        </div>


        <div class="form-group">
            <label for="picture">{{ __('Picture') .": " }}</label>
            <input class="form-control" type="file" name="picture" id="picture">
        </div>

        <div class="form-group"><input type="submit" class="form-control btn btn-success my-2" value="{{ __('Submit') }}"></div>
    </form>

@endsection

{{--@section('scripts')
    @parent
    <script>
        document.addEventListener('keydown', function(e) {

            if(e.ctrlKey && e.keyCode === 83) {
                e.preventDefault();
                console.log('Ctrl + s pressé');
            }
        })
    </script>

@endsection--}}
