@extends('layouts.userLayout')


@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">

                                {{ session('status') }}
                            </div>
                        @endif

                        Hello {{ Auth::user()->name }} !



                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-dark text-white" style="background-color:#224abe !important">
                <h1 class="card-title text-center">
                    <div class="d-flex flex-wrap justify-content-center mt-2">
                        <a><span class="badge hours"></span></a> :
                        <a><span class="badge min"></span></a> :
                        <a><span class="badge sec"></span></a>
                    </div>
                </h1>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            todayDate();
            setInterval(todayDate, 1000);
        });

        function todayDate() {
            var hours = new Date().getHours();
            $(".hours").html((hours < 10 ? "0" : "") + hours);
            var minutes = new Date().getMinutes();
            $(".min").html((minutes < 10 ? "0" : "") + minutes);
            var seconds = new Date().getSeconds();
            $(".sec").html((seconds < 10 ? "0" : "") + seconds);
        }

    </script>
@endsection
