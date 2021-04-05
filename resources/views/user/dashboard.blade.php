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

                    Hello {{Auth::user()->name}} ! You are logged in.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection