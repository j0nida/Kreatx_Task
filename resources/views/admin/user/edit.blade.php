@extends('layouts.adminLayout')

@section('content')

    <div class="container">
        <div class="col-lg-6 col-md-8 mx-auto">
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="text-center mt-2">User Profile for : {{ $user->name }}</h5>
                </div>
                <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <fieldset>
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control">
                                @error('name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="{{ $user->email }}"
                                    class="form-control">
                                @error('email')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="age">Age</label>
                                <input type="number" id="age" name="age" value="{{ $user->age }}" class="form-control">
                                @error('age')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="salary">Salary</label>
                                <input type="number" id="salary" name="salary" value="{{ $user->salary }}"
                                    class="form-control">
                                @error('salary')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">

                                <div class="col-md-6">
                                    <label for="">Department</label>
                                    <select name="department_id" class="form-control">
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" @if ($department->id == $user->department_id) selected @endif>
                                                {{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </fieldset>


                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-flat btn-primary"
                            style="width: 40%; font-size:1.3rem">Save</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection
