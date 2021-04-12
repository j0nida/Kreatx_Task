@extends('layouts.adminLayout')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">List of Departments</div>
                    <div class="card-body">
                        @foreach ($depts as $dept)
                            <ul>
                                <a href="{{ route('dept.users', $dept->id) }}">
                                    <li>{{ $dept->name }}</li>
                                </a>
                                @if (count($dept->children))
                                    @include('admin.department.subDeptList',['subDept' => $dept->children])
                                @endif
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
