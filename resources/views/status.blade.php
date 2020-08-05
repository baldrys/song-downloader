@extends('base')
@section('content')
    @if ($song->status == 'completed')
        <h3>{{ $song->title }}</h3>
        <h3>Click <a href="{{ route('download', ['song' => $song]) }}">here</a> to download it</h3>
    @endif
    @if($song->status == 'in_progress')
        <h3>Download in progress..</h3>
        <p>Please <a href="javascript:;" onclick="window.reload()">refresh</a> this page in a few seconds.</p>
    @endif
    @if ($song->status == 'failed')
        <h3>Download failed!</h3>
        <p>Please try again, if the problem persist, then please contact us.</p>
    @endif
@endsection