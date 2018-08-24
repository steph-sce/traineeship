@extends('layouts.master')

@section('content')
    <form id="contact-form" name="contact-form" action="#" method="">

        <!--Grid row-->
        <div class="row">
            <!--Grid column-->
            <div class="col-md-6">
                <div class="md-form mb-0">
                    <input type="text" id="email" name="email" class="form-control">
                    <label for="email" class="">{{__('E-Mail Address')}}</label>
                </div>
            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

        <!--Grid row-->
        <div class="row">

            <!--Grid column-->
            <div class="col-md-12">

                <div class="md-form">
                    <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                    <label for="message">{{__('Your message')}}</label>
                </div>

            </div>
        </div>
        <!--Grid row-->

    </form>
@endsection