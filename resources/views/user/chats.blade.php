@extends("layouts.userLayout")

@section('content')
    <div id="app">
        <chat-form :user="{{ Auth::user() }}"></chat-form>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
