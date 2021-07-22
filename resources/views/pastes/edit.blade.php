@extends('layouts.container')

@section('content')
    <h1 class="text-center">Pastebin</h1>
    <p class="h5 text-center text-muted">Update your paste using the form below.</p>

    <div id="update-paste-form" data-paste-slug="{{ $paste->slug }}" data-update-url="{!! $updateUrl !!}">
        <div class="form-group">
            <textarea class="form-control" name="content" rows="5">{{ $paste->content }}</textarea>
        </div>
        <button class="btn btn-primary mt-1">Update</button>
    </div>

    <!-- Success modal -->
    <div class="modal fade" id="success-modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Paste Updated</h5>
                </div>
                <div class="modal-body">
                    <p><strong>Important:</strong> Your update URL has not changed, be sure to keep it for future use!</p>
                    <p>Your paste has been successfully updated! You can access it by clicking <a href="" class="paste-url">here</a>.</p>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-primary paste-url">Go</a>
                </div>
            </div>
        </div>
    </div>
@endsection
