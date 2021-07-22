@extends('layouts.container')

@section('content')
    <h1 class="text-center">Saved Paste</h1>
    <textarea class="form-control" rows="5" disabled id="paste-content">{{ $paste->content }}</textarea>
@endsection
