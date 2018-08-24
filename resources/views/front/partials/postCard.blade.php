    <div class="card my-2 bg-light" style="min-height: 15vh;">
        <h5 class="card-header">
            @forelse($post->categories as $category)
                {{$category->name}}
                @empty
            @endforelse
        </h5>
        <div class="card-body">
            <img class="col-6 pt-3" src="{{asset('images/' . $post->picture->link) }}" alt="{{$post->picture->title}}">
            <div class="col-6 pt-3 float-right">
                <h4>{{$post->title}}</h4>
                <p>{{$post->description}}</p>

            </div>
            <ul class="list-group col-6 pt-3" style="padding-left: 15px">
                <li class="list-group-item"> {{__('Start date') .": "}}{{$post->start_date->format('d-m-Y')}}</li>
                <li class="list-group-item">{{__('End date') .": "}}{{$post->end_date->format('d-m-Y')}}</li>
                @if(isset($show) && $show === true)
                    <li class="list-group-item">{{__('Max students') . ": "}}{{$post->max_students}}</li>
                @endif
            </ul>

        </div>
        @if(!isset($show))
            <div class="card-footer">
                <a class="btn btn-info btn-block" href="{{route('show', $post)}}">Voir le détail</a>
            </div>
        @endif
    </div>