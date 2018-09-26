@extends('layouts.master')
{{--@TODO : refactoriser le JS pour l'exporter dans un fichier | renommer les variables url selon le contexte afin de pouvoir simplement initialiser les variables /g --}}
@section('content')

    <div class="back-button-container">
        <a href="{{ route('post.index') }}" class="text-lime back-button mt2">{{ __('Back to dashboard') }}</a>
    </div>

    @if($search !== null)
        {{ $posts->appends($search)->links() }}
    @else
        {{ $posts->links() }}
    @endif

    @if(count($posts) > 0)
        <div class="mt2">
            <label class="check-control" for="checkall"><input type="checkbox" id="checkall"><span>Tout cocher</span></label>
        </div>
    <table class="table mt2">
        <thead>
            <tr>
                <td scope="col">#</td>
                {{--<th scope="col">Id</th>--}}
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
                <td><label data-postid="{{ $post->id }}" for="{{'check' . $post->id }}"><input type="checkbox" id="{{'check' . $post->id }}"><span>&nbsp;</span></label></td>
                {{--<td>{{ $post->id }}</td>--}}
                <td>{{ $post->post_type }}</td>
                <td><a href="{{ route('show', $post) }}">{{ $post->title }}</a></td>
                <td class="hide-on-small-only">{{ $post->start_date->format(__('Y-m-d')) }}</td>
                <td class="hide-on-small-only">{{ $post->end_date->format(__('Y-m-d')) }}</td>
                <td class="center">
                    <a class="btn-floating restore-item lime darken-2">
                        <i class="material-icons">undo</i>
                    </a>
                    <form action="{{ route('draft', $post) }}" class="hide">
                        @csrf
                    </form>
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

        @if($search !== null)
            {{ $posts->appends($search)->links() }}
        @else
            {{ $posts->links() }}
        @endif
    <div class="fixed-action-btn left hide">
        <a class="btn-floating btn-large lime darken-1">
            <i class="material-icons">add</i>
        </a>
        <ul>
            <li><div class="btn-floating btn-large red multiple-deletion"><i class="left material-icons">delete_forever</i></div><a href="#" class="btn-floating mobile-fab-tip">{{ __('Multiple deletion') }}</a></li>
            <li><div class="multiple-restore btn-floating btn-large"><i class="left material-icons">undo</i></div><a href="#" class="btn-floating mobile-fab-tip">{{ __('Multiple restore') }}</a></li>
        </ul>
    </div>
    @else
        @if($search === null)
            <div class="row center">
                <p class="col s12">
                    {{ __('No records are flagged as trashed') }}
                </p>
            </div>
        @else
            <div class="row center">
                <p class="col s12">
                    {{ __('No matches for this search') }}
                </p>
            </div>
        @endif

    @endif


@endsection

@section('scripts')
    @parent
    <script src="{{ asset('js/fab.js') }}" type="text/javascript"></script>
    <script>
        var timeout = null;
        var route = '{{ route('showTrash') }}';
        const noPosts = swal.mixin({
            type : 'error',
            title : '{{ __('No posts selected') }}'
        })
        $('label[for="checkall"]').on('click', function() {
            if($('#checkall').prop('checked') === true) {
                $('input[type=checkbox]:not(#checkall)').each(function() {
                    $(this).prop('checked', true)
                })
            } else {
                $('input[type=checkbox]:not(#checkall)').each(function() {
                    $(this).prop('checked', false)
                })

            }
        });
        $('.delete-item').on('click', function(e) {
            e.preventDefault();
            swal({
                type : 'warning',
                text : "{{ __('Are you sure you want to definitely delete this post ?') }}",
                showCancelButton : true,
                cancelButtonColor : '#',
                confirmButtonColor : '#c0ca33',
                cancelButtonColor : '#c64622',
                confirmButtonText : '{{ __('Confirm') }}',
                cancelButtonText : '{{ __('Undo') }}'

            }).then((result) => {
                if(result.value) {
                    $(this).next('form').submit();

                }
            })
        });

        $('.restore-item').on('click', function(e) {
            e.preventDefault();
            $(this).next('form').submit();
        })

        $('.multiple-deletion').on('click', function(e) {
            var url = '{{ route('massDelete') }}';
            var checkedPostID = [];
            if($('input[type=checkbox]:checked').length > 0) {
                $('input[type=checkbox]:checked:not(#checkall)').each(function(){
                    checkedPostID.push($(this).parent('label').data('postid'));
                });
                swal({
                    type : 'warning',
                    showCancelButton : 'true',
                    title : '{{ __('Delete these posts ?') }}',
                    text : '{{ __('Once deleted you\'ll not be able to undo') }}',
                    confirmButtonText : '{{ __('Confirm') }}',
                    cancelButtonText : '{{ __('Undo') }}',
                    confirmButtonColor : '#c0ca33',
                    cancelButtonColor : '#c64622'
                }).then((result) => {
                    if(result.value) {
                        $.ajax({
                            url: url + "?ids=" + checkedPostID,

                            success: function (data) {
                                swal({
                                    type: 'success',
                                    text : '{{__('Posts has been deleted') }}'
                                }).then(()=> {
                                        window.location.reload();
                                    }
                                )
                            },
                            error: function (error) {
                                console.log(error)

                            },
                            complete: function () {

                            }
                        });


                    }
                })

            }
        });

        $('.multiple-restore').on('click', function(e) {
            var url = '{{ route('restore') }}';
            var checkedPostID = [];
            if($('input[type=checkbox]:checked').length > 0) {
                $('input[type=checkbox]:checked:not(#checkall)').each(function(){
                    checkedPostID.push($(this).parent('label').data('postid'));
                });
                swal({
                    type : 'warning',
                    showCancelButton : 'true',
                    title : '{{ __('Restore these posts ?') }}',
                    text : '{{ __('Their status will be set to draft') }}',
                    confirmButtonText : '{{ __('Confirm') }}',
                    cancelButtonText : '{{ __('Undo') }}',
                    confirmButtonColor : '#c0ca33',
                    cancelButtonColor : '#c64622'
                }).then((result) => {
                    if(result.value) {
                        $.ajax({
                            url: url + "?ids=" + checkedPostID,

                            success: function (data) {
                                swal({
                                    type: 'success',
                                    text : '{{__('Posts has been restored') }}'
                                }).then(()=> {
                                        window.location.reload();
                                    }
                                )
                            },
                            error: function (error) {

                            },
                            complete: function () {

                            }
                        });


                    }
                })

            } else {
                noPosts({
                    text : '{{ __('Please select at least 1 item') }}'
                });
            }
        });

        @if(Session::has('success'))
                swal({
            toast : true,
            type : 'success',
            text : '{{ Session::get('success') }}',
            showConfirmButton: false,
            timer : 2500
                });
        @endif

    </script>
    <script src="{{asset('js/search.js')}}" type="text/javascript"></script>

@endsection

