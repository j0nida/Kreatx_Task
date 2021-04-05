@extends("layouts.userLayout")

@section('content')
    <div id="app">
    </div>
@endsection

@section('scripts')
 <script src="{{ asset('js/app.js') }}"></script> 
 <script>
     window.Echo.join('chat')
                .listen('ChatMessageWasReceived',() => {
                    alert("lidh")
                })
 </script>
@endsection