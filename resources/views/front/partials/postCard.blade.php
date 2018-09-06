<div class="row card link-container">
    <div class="center card-image col s12 m4">
        @if(count($post->picture) > 0)
            <img class="responsive-img" src="{{ asset('/images/'. $post->picture->link) }}" alt="{{ $post->picture->title }}">
            <span id="postcard-title" class="card-title hide-on-med-and-up">{{ $post->title }}</span>

            @else
            <img class="responsive-img" src="{{ asset('/img/no-picture.png') }}" alt="{{ __('No picture linked to this post') }}">
            <span id="postcard-title" class="card-title hide-on-med-and-up">{{ $post->title }}</span>
        @endif
        @if($details === true)
            <ul class="left-align browser-default hide-on-small-only">
                <li class=""><i class="material-icons">date_range</i>{{ $post->start_date->format(__('Y-m-d')) }} -> {{ $post->end_date->format(__('Y-m-d')) }}</li>
                <li><i class="material-icons">payment</i>{{ $post->price . __('$')}}</li>
                <li><i class="material-icons">people_outline</i>{{ $post->max_students }}</li>
            </ul>
        @endif
    </div>
    @if($details === true)
        <ul class="left-align browser-default hide-on-med-and-up">
            <li class=""><i class="material-icons">date_range</i>{{ $post->start_date->format(__('Y-m-d')) }} -> {{ $post->end_date->format(__('Y-m-d')) }}</li>
            <li class=""><i class="material-icons">access_time</i> {{ $post->getDiffDate() }}</li>
        </ul>
    @endif
    <div class="col s12 m8 mt1">
        <div class="row hide-on-small-only valign-wrapper card-header">
            <span class="col s6">{{ strtoupper($post->title) }}</span>
            <span class="col s3 time"><i class="material-icons">access_time</i> {{ strtoupper($post->getDiffDate()) }}</span>
            <span class="col s3 post-type right">{{ strtoupper($post->post_type) }}</span>
        </div>
        <div class="row mt2">
            <div class="col s10 offset-s1">
                {{ $post->description }}
            </div>
        </div>
    </div>
    @if($details === false)
        <div class="col s6 offset-s3 center">
            <a href="{{route('show', $post)}}" class="btn lime darken-1">{{ __('More details') }}</a>
        </div>
    @endif
</div>