@extends('layouts.master')

@section('content')

    <form class="col-md-6 col-12 offset-md-3 text-center"id="contact-form" name="contact-form" action="#" method="">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-3 col-form-label">{{__('E-Mail Address')}}</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" placeholder="{{__('E-Mail Address')}}">
                </div>
            </div>

        <div class="form-group row">
            <label for="message" class="col-sm-3 col-form-label">{{__('Your message')}}</label>
            <div class="col-sm-9">
                <textarea type="text" class="form-control">{{__('Type your message...')}}</textarea>
            </div>
        </div>

        <input type="submit" class="btn btn-success" value="{{__('Submit')}}">

    </form>
@endsection