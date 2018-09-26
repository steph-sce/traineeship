@extends('layouts.master')

{{--@TODO: Gérer le retour à la bonne page lors d'une action--}}

@section('content')
        @if($search !== null)
            {{ $posts->appends($search)->links() }}
        @else
            {{ $posts->links() }}
        @endif
    @if(count($posts) > 0)
        <div class="mt2">
            <label class="check-control" for="checkall"><input type="checkbox" id="checkall"><span>Tout cocher</span></label>
        </div>

        <table class="highlight mt1">
            <thead>
            <tr>
                <th scope="col">#</th>
                {{--<th scope="col">Id</th>--}}
                <th scope="col">{{ __('Type') }}</th>
                <th scope="col">{{ __('Title') }}</th>
                <th scope="col" class="hide-on-small-only">{{ __('Start date') }}</th>
                <th scope="col" class="hide-on-small-only">{{ __('End date') }}</th>
                <th scope="col">{{ __('Status') }}</th>
                <th scope="col" class="center">{{ __('Actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($posts as $post)
                <tr class="clikable-row" data-href="{{route('show', $post->id)}}">
                    <td><label data-postid="{{ $post->id }}" for="{{'check' . $post->id }}"><input type="checkbox" id="{{'check' . $post->id }}"><span>&nbsp;</span></label></td>
                    {{--<th scope="row">{{ $post->id }}</th>--}}
                    <td>{{ $post->post_type }}</td>
                    <td><a href="{{ route('show', $post->id) }}">{{ $post->title }}</a></td>
                    <td class="hide-on-small-only">{{ $post->start_date->format(__('Y-m-d')) }}</td>
                    <td class="hide-on-small-only">{{ $post->end_date->format(__('Y-m-d')) }}</td>
                    <td>{{ $post->status }}</td>
                    <td class="center">
                        <a href="{{ route('post.edit', $post) }}" class="large-control btn action-button lime darken-2 hide-on-med-and-down"><i class="material-icons">edit</i>{{ __('Edit') }}</a>&nbsp;
                        <a data-post="{{ $post->id }}" href="{{ route('trash', $post) }}" class="delete-item large-control btn red action-button hide-on-med-and-down"><i class="material-icons">delete_forever</i> {{ __('Trash') }}</a>
                        <a href="{{ route('post.edit', $post) }}" class="btn-floating btn lime darken-2 action-button show-on-medium-and-down hide-on-large-only mt1"><i class="material-icons">edit</i></a>
                        <a data-post="{{ $post->id }}" href="{{ route('trash', $post) }}" class="delete-item btn-floating btn red action-button show-on-medium-and-down hide-on-large-only mt1"><i class="material-icons">delete_forever</i></a>

                    </td>
                </tr>
            @empty
                <p>Aucun enregistrements présents en base pour le moment.</p>
            @endforelse
            </tbody>
        </table>

        @if($search !== null)
            {{ $posts->appends($search)->links() }}
        @else
            {{ $posts->links() }}
        @endif

    @else
        @if($search === null)
            <div class="row center">
                <p class="col s12">
                    {{ __('No records are present') }}
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
        <div class="fixed-action-btn left hide">
            <a class="btn-floating btn-large lime darken-1">
                <i class="material-icons">add</i>
            </a>
            <ul>
                <li><div class="multiple-trash btn-floating btn-large red"><i class="left material-icons">delete_sweep</i></div><a href="#" class="btn-floating mobile-fab-tip">{{ __('Multiple deletion') }}</a></li>
                <li><a href="{{ route('showTrash') }}" class="btn-floating btn-large red"><i class="left material-icons">delete_forever</i></a><a href="#" class="btn-floating mobile-fab-tip">{{ __('Go to trash') }}</a></li>
                <li><a href="{{ route('post.create') }}" class="btn-floating btn-large teal lighten-2"><i class="material-icons">note_add</i></a><a href="#" class="btn-floating mobile-fab-tip">{{ __('Create new post') }}</a></li>
            </ul>
        </div>



@endsection

@section('scripts')
    @parent
    <script src="{{ asset('js/fab.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $('main').removeClass('container');
        var route = '{{ route('post.index') }}'
        const toast = swal.mixin({
            toast: true,
            position: 'bottom',
            showConfirmButton: false,
            timer: 2000
        })
        const confirm = swal.mixin({
            type : 'warning',
            showCancelButton : 'true',
            confirmButtonText : '{{ __('Confirm') }}',
            cancelButtonText : '{{ __('Undo') }}',
            confirmButtonColor : '#c0ca33',
            cancelButtonColor : '#c64622',

        })
        $(document).on('click', '.delete-item', function(e) {
            var self = $(this);
            var postID = self.data('post');
            var url = '{{ route('trash', ":post")}}';
            url = url.replace(":post", postID);
            e.preventDefault();
            confirm({
                title : '{{ __('Trash this post ?') }}',
                text : '{{ __('Once trashed you\'ll be able to undo') }}'
            }).then((result) => {
                if(result.value) {
                    window.location.href = url
                }
            })
        });

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
        })

        $('.multiple-trash').on('click', function(e) {
            var url = '{{ route('massTrash') }}';
            var checkedPostID = []
            if($('input[type=checkbox]:checked').length > 0){
                $('input[type=checkbox]:checked:not(#checkall)').each(function(){
                    checkedPostID.push($(this).parent('label').data('postid'));
                });
                swal({
                    type : 'warning',
                    showCancelButton : 'true',
                    title : '{{ __('Trash these posts ?') }}',
                    text : '{{ __('Once trashed you\'ll be able to undo') }}',
                    confirmButtonText : '{{ __('Confirm') }}',
                    cancelButtonText : '{{ __('Undo') }}',
                    confirmButtonColor : '#c0ca33',
                    cancelButtonColor : '#c64622',
                    timer : 7500
                }).then((result) => {
                    if(result.value) {
                        $.ajax({
                            url: url + "?ids=" + checkedPostID,
                            data: {},

                            success: function (data) {
                                swal({
                                    type: 'success',
                                    text : '{{__('Posts has been trashed') }}'
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
                swal({
                    type : 'error',
                    text : '{{ __('No posts selected') }}'
                })
            }



        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
    </script>
    <script src="{{ asset('js/search.js') }}"></script>
    <script>
        @if(Session::has('success'))
        toast({
            type : 'success',
            text : '{{ Session::get('success') }}'
        });
        @endif
        @if(Session::has('warning'))
            toast({
            type : 'warning',
            text : '{{ Session::get('warning') }}'
        })
        @endif

    </script>
@endsection