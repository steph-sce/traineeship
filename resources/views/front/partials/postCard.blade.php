    <div class="card my-2 bg-light" style="min-height: 15rem;">
        <h5 class="card-header">{{$post->title}}</h5>
        <div class="card-body">
            <img class="col-4 pt-3" src="{{asset('images/' . $post->picture->link) }}" alt="{{$post->picture->title}}">
            <div class="col-8 pt-3 float-right">{{$post->description}}</div>
            <ul class="list-group col-4 pt-3" style="padding-left: 15px">
                <li class="list-group-item">Date de début: {{$post->start_date->format('d-m-Y')}}</li>
                <li class="list-group-item">Date de fin: {{$post->end_date->format('d-m-Y')}}</li>
            </ul>
        </div>
    </div>