    <div class="card my-2 bg-light" style="min-height: 15rem;">
        <h5 class="card-header">
            @forelse($post->categories as $category)
                {{$category->name}}
                @empty
            @endforelse
        </h5>
        <div class="card-body">
            <img class="col-4 pt-3" src="{{asset('images/' . $post->picture->link) }}" alt="{{$post->picture->title}}">
            <div class="col-8 pt-3 float-right">
                <h4>{{$post->title}}</h4>
                <p>{{$post->description}}</p>

            </div>
            <ul class="list-group col-4 pt-3" style="padding-left: 15px">
                <li class="list-group-item"> {{__('Start date') .": "}}{{$post->start_date->format('d-m-Y')}}</li>
                <li class="list-group-item">{{__('End date') .": "}}{{$post->end_date->format('d-m-Y')}}</li>
            </ul>
        </div>
    </div>