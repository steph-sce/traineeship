<div class="row">
    <a href="{{route('post.create')}}" class="col s2 btn lime darken-1 hide-on-med-and-down">{{__('Create new post')}}</a>
    <a href="{{route('showTrash')}}" class="col right btn red darken-1 hide-on-med-and-down"><span class="white red-text badge">{{ $trashed }}</span>{{__('Go to trash')}}</a>
</div>
{{ $posts->appends($search)->links() }}
<table class="highlight">
    <thead>
    <tr>
        <th scope="col">Id</th>
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
            <th scope="row">{{ $post->id }}</th>
            <td>{{ $post->post_type }}</td>
            <td><a href="{{ route('show', $post->id) }}">{{ $post->title }}</a></td>
            <td class="hide-on-small-only">{{ $post->start_date->format(__('Y-m-d')) }}</td>
            <td class="hide-on-small-only">{{ $post->end_date->format(__('Y-m-d')) }}</td>
            <td>{{ $post->status }}</td>
            <td class="center">
                <a href="{{ route('post.edit', $post) }}" class="btn action-button lime darken-2 hide-on-med-and-down"><i class="material-icons">edit</i>{{ __('Edit') }}</a>&nbsp;
                <a href="{{ route('trash', $post) }}" class="btn red action-button hide-on-med-and-down"><i class="material-icons">delete_forever</i> {{ __('Trash') }}</a>
                <a href="{{ route('post.edit', $post) }}" class="btn-floating btn lime darken-2 action-button show-on-medium-and-down hide-on-large-only mt1"><i class="material-icons">edit</i></a>
                <a href="{{ route('trash', $post) }}" class="btn-floating btn red action-button show-on-medium-and-down hide-on-large-only mt1"><i class="material-icons">delete_forever</i></a>

            </td>
        </tr>
    @empty
        <p>Aucun enregistrements présents en base pour le moment.</p>
    @endforelse
    </tbody>
</table>

{{ $posts->appends($search)->links() }}

<div class="fixed-action-btn left show-on-medium-and-down hide-on-large-only">
    <a class="btn-floating btn-large lime darken-1">
        <i class="material-icons">add</i>
    </a>
    <ul>
        <li><a href="{{ route('showTrash') }}" class="btn-floating btn-large red"><i class="left material-icons">delete</i></a><a href="#" class="btn-floating mobile-fab-tip">{{ __('Go to trash') }}</a></li>
        <li><a href="{{ route('post.create') }}" class="btn-floating btn-large teal lighten-2"><i class="material-icons">note_add</i></a><a href="#" class="btn-floating mobile-fab-tip">{{ __('Create new post') }}</a></li>
    </ul>
</div>