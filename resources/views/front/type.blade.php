@extends('layouts.master')

@section('content')


    @if($search !== null)
        {{ $posts->appends($search)->links() }}
    @else
        {{ $posts->links() }}
    @endif

    @if(count($posts) > 0)
        @forelse($posts as $post)
            @include('front.partials.postCard')
        @empty
        @endforelse

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
            var route = '{{ route('stages') }}'
        @elseif(Route::is('formations'))
            var url = '/searchFormations';
            var route = '{{ route('formations') }}'
        @endif
    </script>
    <script src="{{ asset('/js/search.js') }}" type="text/javascript"></script>
@endsection