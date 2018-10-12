@if ($model instanceof App\Question)
    @php
        $name = 'question';
        $firstURISegment = 'questions';
    @endphp
@elseif ($model instanceof App\Answer)
    @php
        $name = 'answer';
        $firstURISegment = 'answers';
    @endphp
@endif

@php
    $formId = "{$name}-{$model->id}";
    $formAction = "/{$firstURISegment}/{$model->id}/vote";

@endphp

<div class="d-flex flex-column vote-controls">
    <a title="This {{ $name }} is useful"
    class="vote-up {{ Auth::guest() ? 'off': '' }}"
    onclick="event.preventDefault(); document.getElementById('upvote-{{ $formId }}').submit();"
    >
        <i class="fas fa-caret-up fa-3x"></i>
    </a>
    <form action="{{ $formAction }}" id="upvote-{{ $formId }}" method="post" class="hidden">
        @csrf
        <input type="hidden" name="vote" value="1">
    </form>
    <span class="vote-count">{{ $model->votes_count }}</span>
    <a title="This {{ $name }} is not useful"
        class="vote-down {{ Auth::guest() ? 'off': '' }}"
        onclick="event.preventDefault(); document.getElementById('downvote-{{ $formId}}').submit();"
        >
        <i class="fas fa-caret-down fa-3x"></i>
    </a>
    <form action="{{ $formAction }}" id="downvote-{{ $formId }}" method="post" class="hidden">
        @csrf
        <input type="hidden" name="vote" value="-1">
    </form>
    @if ($model instanceof App\Question)
        @include('shared._favorite', [
            'model' => $model
        ])
    @elseif ($model instanceof App\Answer)
        @include('shared._accept', [
            'model' => $model
        ])
    @endif

</div>
