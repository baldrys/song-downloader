@extends('base')
@section('title', 'Video Downloader')
@section('content')
<form method="post" action="{{ route('prepare') }}">
	@csrf
	@if(Session::has('error'))
	<div class="alert alert-danger">{{ Session::get('error') }}</div>
	@endif
	<div class="form-group">
		<input name="songTitle" type="text" required class="form-control @error('songTitle')  is-invalid @enderror" id="songTitle" aria-describedby="url" value="{{ old('songTitle') }}" autocomplete="off" autofocus>
		@error('songTitle')
		<div class="invalid-feedback">{{ $message }}</div>
		@enderror
	</div>
	<div class="text-center">
		<button class="btn btn-lg btn-primary">Download</button>
	</div>
</form>
@endsection