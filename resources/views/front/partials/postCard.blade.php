    <div class="" style="">
        <div class="row">

            @if(count($post->picture) > 0)
                <img class="col s12 m3" src="{{asset('images/' . $post->picture->link) }}" alt="{{$post->picture->title}}">
                @else
                <div class="col s12 m3">{{ __('No picture linked to this post') }}</div>
            @endif
            <div class="col s12 m9">
                <div class="col s9">
                    <h4>{{ $post->title }}</h4>
                </div>
                <div class="col s3"><p class="right">{{ strtoupper($post->post_type) }}</p></div>
            </div>
            <hr class="col s12 m9">

                <p class="col s12 m9 truncate">{{ $post->description }}</p>

            @if($details === true)
                    <ul class="list-group col-12 col-md-3 pt-3" style="padding-left: 15px">
                        <li class="list-group-item"> {{__('Start date') .": "}}{{$post->start_date->format('d-m-Y')}}</li>
                        <li class="list-group-item">{{__('End date') .": "}}{{$post->end_date->format('d-m-Y')}}</li>
                        <li class="list-group-item">{{__('Max students') . ": "}}{{$post->max_students}}</li>
                    </ul>
            @endif

        </div>
        @if($details === false)
            <div class="row">
                <a class="btn right" href="{{route('show', $post)}}">{{ __('More details') }}</a>
            </div>
        @endif
    </div>