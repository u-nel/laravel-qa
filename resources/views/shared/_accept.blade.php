@can ('accept', $model)
    <a title="Mark this answer as best answer"
        class="{{ $model->status }} mt-2 favorited"
        onclick="event.preventDefault(); document.getElementById('accept-answer-{{$model->id}}').submit();"
        >
        <i class="fas fa-check fa-2x"></i>
    </a>
    <form action="{{ route('answers.accept', $model->id) }}" id="accept-answer-{{$model->id}}" method="post" class="hidden">
        @csrf
    </form>
@else
    @if($model->is_best)
    <a title="The question owner accepted this answer as best answer"
        class="{{ $model->status }} mt-2 favorited"
        >
            <i class="fas fa-check fa-2x"></i>
    </a>
    @endif
@endcan
