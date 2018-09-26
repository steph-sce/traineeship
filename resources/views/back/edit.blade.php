@extends('layouts.master')

@section('content')
    <div class="back-button-container">
        <a href="{{ route('post.index') }}" class="text-lime back-button mt2">{{ __('Back to dashboard') }}</a>
    </div>
    <form class="mt2 col s12 l8 offset-l2" action="{{route('post.update', $post)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="row">
            <div class="input-field col s12">
                <input class="validate" type="text" name="title" id="title" placeholder="{{ __('Title') }}" value="{{ old('title', $post->title) }}" data-length="50">
                <label for="" class="active"></label>
                @if(Session::has('errors'))
                    <span class="helper-text" data-error="{{ $errors->first('title') }}"></span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <textarea class="materialize-textarea validate" name="description" id="description">{{ old('description', $post->description) }}</textarea>
                <label for="description">{{ __('Description') }}</label>
                @if(Session::has('errors'))
                    <span class="helper-text" data-error="{{ $errors->first('description') }}"></span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="chips input-field col s12">
                <input class="input" name="categories" id="categories">
            </div>
        </div>

        <input type="hidden" id="hcategories" name="hcategories">

        <div class="row">
            <div class="input-field col s12">
                <select name="post_type" id="post_type">

                    <option value="stage" {{ old('post_type', $post->post_type) === "Stage" ? "selected" : "" }}>Stage</option>
                    <option value="formation" {{ old('post_type', $post->post_type) === "Formation" ? "selected" : "" }}>Formation</option>
                </select>
                <label for="post_type">{{ __('Select post type') }}</label>
                @if(Session::has('errors'))
                    <span class="helper-text" data-error="{{ $errors->first('post_type') }}"></span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input class="datepicker" name="start_date" id="start_date" type="text" value="{{ old('start_date', $post->start_date->format(__('Y-m-d'))) }}">
                <label class="active" for="start_date">{{ __('Start date') }}</label>
                @if(Session::has('errors'))
                    <span class="helper-text" data-error="{{ $errors->first('start_date') }}"></span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input class="datepicker" name="end_date" id="end_date" type="text" value="{{ old('end_date', $post->end_date->format(__('Y-m-d'))) }}">
                <label class="active" for="end_date">{{ __('End date') }}</label>
                @if(Session::has('errors'))
                    <span class="helper-text" data-error="{{ $errors->first('end_date') }}"></span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input type="number" min="0" max="99999.99" step="0.01" name="price" id="price" value="{{ old('price', $post->price) }}">
                <label for="price">{{ __('Price') }}</label>
                @if(Session::has('errors'))
                    <span class="helper-text" data-error="{{ $errors->first('price') }}"></span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input type="number" min="0" max="65535" step="1" name="max_students" id="max_students" value="{{ old('max_students', $post->max_students) }}">
                <label for="max_students">{{ __('Max students') }}</label>
                @if(Session::has('errors'))
                    <span class="helper-text" data-error="{{ $errors->first('max_students') }}"></span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <select name="status" id="status">
                    <option value="draft" {{ old('status', $post->status) === 'draft' ? "selected" : "" }}>{{ __('Draft') }}</option>
                    <option value="published" {{ old('status', $post->status) === 'published' ? "selected": "" }}>{{ __('Published') }}</option>
                </select>
                <label for="status">{{ __('Status') }}</label>
                @if(Session::has('errors'))
                    <span class="helper-text" data-error="{{ $errors->first('status') }}"></span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="file-field input-field">
                <div class="btn lime darken-1">
                    <span>{{ __('Choose a file') }}</span>
                    <input type="file" name="picture" id="picture">
                </div>
                <div class="file-path-wrapper">
                    <input type="text" class="file-path validate">
                </div>
                @if(Session::has('errors'))
                    <span class="helper-text" data-error="{{ $errors->first('picture') }}"></span>
                @endif
            </div>
            @if(count($post->picture) > 0)
                <div class="col s4">
                    <p>Image déjà présente</p>
                    <img class="responsive-img" src="{{ asset('images/' . $post->picture->link) }}" alt="">
                </div>
            @endif
        </div>

        <div class="center">
            <button class="waves-effect waves-light btn lime darken-1" type="submit">{{ __('Submit') }}</button>
        </div>
    </form>

    <div class="fixed-action-btn  right" onclick="topFunction()" id="myBtn" title="Go to top">
        <a class="btn-floating btn-large lime darken-1"><i class="material-icons">expand_less</i></a>
    </div>

@endsection


@section('scripts')
    @parent
    <script>
        // When the user scrolls down 200px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                document.getElementById("myBtn").style.display = "block";
            } else {
                document.getElementById("myBtn").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            $("html, body").animate({scrollTop : 0}, 1000);
            //document.body.scrollTop = 0; // For Safari
            //document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }


        $('#title').characterCounter();
        var data = {}
        var tagsData = []
        var autocompleteData = {}
        @forelse($categories as $id => $category)
            data['{{$id}}'] = '{{$category->name}}'
        @empty
        @endforelse

        @forelse($postCategories as $category)
                tagsData.push({tag : '{{ $category->name }}'});
        @empty
        @endforelse

        $.each(data, function(index, value) {
            autocompleteData[value] = null;
        });
        console.log(autocompleteData);

        var formPrevent = true;
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
            elems = document.querySelectorAll('.chips');
            var options = {
                data: tagsData,
                autocompleteOptions : {
                    data : autocompleteData
                }

            };
            var chips = M.Chips.init(elems, options);

            console.log(chips);
            $('form').on('submit', function(e) {
                if(formPrevent === true) {
                    e.preventDefault();
                    console.log($('#end_date').val())
                    var data = chips[0].chipsData;
                    var chipsTab = [];
                    data.forEach(function(i) {
                        chipsTab.push(i.tag);
                    })

                    $('#hcategories').val(chipsTab);
                    formPrevent = false;
                    $('form').submit();
                }


            })
        });
        document.addEventListener('DOMContentLoaded', function() {
            console.log({{ old('end_date') }})
            var options = {
                minDate : new Date(),
                yearRange : 4,
                format : 'dd-mm-yyyy',
                firstDay : 1,
                i18n : {
                    cancel : "Annuler",
                    months : [
                        'Janvier',
                        'Février',
                        'Mars',
                        'Avril',
                        'Mai',
                        'Juin',
                        'Juillet',
                        'Août',
                        'Septembre',
                        'Octobre',
                        'Novembre',
                        'Decembre'
                    ],
                    monthsShort : [
                        'Jan',
                        'Fev',
                        'Mar',
                        'Avr',
                        'Mai',
                        'Juin',
                        'Juil',
                        'Août',
                        'Sep',
                        'Oct',
                        'Nov',
                        'Dec'
                    ],
                    weekdays : [
                        'Dimanche',
                        'Lundi',
                        'Mardi',
                        'Mercredi',
                        'Jeudi',
                        'Vendredi',
                        'Samedi'
                    ],
                    weekdaysShort : [
                        'Dim',
                        'Lun',
                        'Mar',
                        'Mer',
                        'Jeu',
                        'Ven',
                        'Sam'
                    ],
                    weekdaysAbbrev : ['D', 'L', 'M', 'M', 'J', 'V', 'S']
                }
            }
            var elems = document.querySelectorAll('.datepicker');
            var instances = M.Datepicker.init(elems, options);
            @if(old('start_date'))
                instances[0].setDate(new Date('{{ date('m-d-Y', strtotime(old('start_date'))) }}'));
            @else
                instances[0].setDate(new Date('{{ $post->start_date }}'));
                console.log(instances[0].date);
            @endif

            @if(old('end_date'))
                instances[1].setDate(new Date('{{ date('m-d-Y', strtotime(old('end_date'))) }}'));
            @else
                instances[1].setDate(new Date('{{ $post->end_date->format('m-d-Y') }}'));
            @endif
            window.instances = instances;
        });
        $(document).on('click', '.datepicker-day-button', function() {
            $('td .is-today').removeClass('is-today');
        })

    </script>
    @if(Session::has('errors'))
        <script>
            @if($errors->first('title') != '')
            $('#title').addClass('invalid');
            @endif
            @if($errors->first('description') != '')
            $('#description').addClass('invalid');
            @endif
            @if($errors->first('post_type') != '')
            $('#post_type').addClass('invalid');
            @endif
            @if($errors->first('start_date') != '')
            $('#start_date').addClass('invalid');
            @endif
            @if($errors->first('end_date') != '')
            $('#end_date').addClass('invalid');
            @endif
            @if($errors->first('price') != '')
            $('#price').addClass('invalid');
            @endif
            @if($errors->first('max_students') != '')
            $('#max_students').addClass('invalid');
            @endif
            @if($errors->first('status') != '')
            $('#status').addClass('invalid');
            @endif
            @if($errors->first('picture') != '')
            $('#picture').addClass('invalid');
            @endif
        </script>
    @endif

@endsection