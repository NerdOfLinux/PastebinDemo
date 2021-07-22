@extends('layouts.baseof')

@section('body')
    <main class="container">
        @yield('content')

        <div class="alert alert-warning mt-2">
            <strong>Warning:</strong> this is a demo website, and its database is regularly cleared.
        </div>
    </main>
@endsection
