    <div class="card my-2 bg-light" style="min-height: 15vh;">
        <h5 class="card-header">
            @forelse($post->categories as $category)
                {{$category->name}}
                @empty
            @endforelse
        </h5>
        <div class="card-body">

            @if(count($post->picture) > 0)
                <img class="col-12 col-md-3 pt-3" src="{{asset('images/' . $post->picture->link) }}" alt="{{$post->picture->title}}">
                @else
                <div class="col-12 col-md-3">{{ __('No picture linked to this post') }}</div>
            @endif
            <div class="col-12 col-md-9 pt-3 float-right">
                <h4>{{$post->title}}</h4>
                <p>{{$post->description}}</p>

            </div>
            @if($details === true)
                    <ul class="list-group col-12 col-md-3 pt-3" style="padding-left: 15px">
                        <li class="list-group-item"> {{__('Start date') .": "}}{{$post->start_date->format('d-m-Y')}}</li>
                        <li class="list-group-item">{{__('End date') .": "}}{{$post->end_date->format('d-m-Y')}}</li>
                        <li class="list-group-item">{{__('Max students') . ": "}}{{$post->max_students}}</li>
                    </ul>
            @endif

        </div>
        @if($details === false)
            <div class="card-footer p-0">
                <a class="btn btn-info btn-block" href="{{route('show', $post)}}">Voir le détail</a>
            </div>
        @endif
    </div>