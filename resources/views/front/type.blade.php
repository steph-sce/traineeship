@extends('layouts.master')

@section('content')


    @if($search !== null)
        {{ $posts->appends($search)->links() }}
    @else
        {{ $posts->links() }}
    @endif

    @forelse($posts as $post)
        @include('front.partials.postCard')
    @empty
        Aucune formation correspondante au filtre selectionné n'a été publiée
    @endforelse


    @if($search !== null)
        {{ $posts->appends($search)->links() }}
    @else
        {{ $posts->links() }}
    @endif
@endsection

@section('scripts')
    @parent
    <script>
        @if(Route::is('stages'))
            var url = '/searchStages';
            @else
            var url = '/searchFormations'
        @endif
        var timeout = null;
        $('#search').on('blur', function() {
            $('.close').trigger('click');
        });
        $('#search').on('keyup', function() {
            if(timeout) {
                clearInterval(timeout);
            }
            var value = $(this).val();

            timeout = setTimeout(function() {
                $.ajax({
                    url : url,
                    data : {search : value},

                    success : function(data) {
                        console.log(data);
                        $('main').html(data);
                    }
                });
            }, 200);
            // if(value.length >= 2) {
            //     $.ajax({
            //         url : '/searchStages',
            //         data : {search : value},
            //
            //         success : function(data) {
            //             console.log(data);
            //             $('main').html(data);
            //         }
            //     });
            // }
        })
    </script>
@endsection