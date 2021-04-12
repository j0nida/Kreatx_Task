@extends('layouts.adminLayout')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h3 class="mt-4 mb-5">Hello Administrator ! You are logged in !</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-4 col-sm-8 col-17">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="fas fa-building fa-3x" style="color: orange"></i>
                                </div>
                                <div class="media-body text-right">
                                    <a href="{{ route('departments.details') }}">
                                        <h3>{{ $deptCount }}</h3>
                                        <span>Total Departments</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-8 col-17">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="fas fa-users fa-3x" style="color: green"></i>
                                </div>
                                <div class="media-body text-right">
                                    <a href="{{ route('users') }}">
                                        <h3>{{ $userCount }}</h3>
                                        <span>Total Users</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
