@extends('layouts.container')

@section('content')
    <h1 class="text-center">Pastebin</h1>
    <p class="h5 text-center text-muted">Paste something into the textarea below, then hit save to get a unique URL to share!</p>

    <div id="new-paste-form">
        <div class="form-group">
            <textarea class="form-control" name="content" rows="5"></textarea>
        </div>
        <button class="btn btn-primary mt-1">Create</button>
    </div>

    <!-- Success modal -->
    <div class="modal fade" id="success-modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Paste Created</h5>
                </div>
                <div class="modal-body">
                    <p><strong>Important:</strong> Be sure to keep your edit URL somewhere safe:<br><input class="form-control" id="paste-edit-url" disabled></p>
                    <p>Your paste has been successfully created! You can access it by clicking <a href="" class="paste-url">here</a>.</p>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-primary paste-url">Go</a>
                </div>
            </div>
        </div>
    </div>
@endsection
