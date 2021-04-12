@extends('layouts.adminLayout')

@section('content')

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="text-center mt-2">Add new employee</h5>
                        </div>

                        <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card-body">

                                <fieldset>
                                    <div class="form-group">
                                        <label for="">Full Name</label>
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                        @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" name="email" value="{{ old('email') }}" class="form-control">
                                        @error('email')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="age">Age</label>
                                        <input type="number" id="age" name="age" value="{{ old('age') }}"
                                            class="form-control">
                                        @error('age')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="">Department</label>
                                        <select name="department_id" class="form-control">
                                            <option hidden disabled selected value> -- select an option -- </option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}" @if (old('department_id') == $department->id) selected @endif>
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('department')
                                            <div class="text-danger">
                                                Please select a valid option
                                            </div>
                                        @enderror
                                    </div>


                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" class="form-control">
                                        <option hidden disabled selected value> -- select an option -- </option>
                                        @if (old('role') == 'Admin')
                                            <option value="Admin" selected>Admin</option>
                                            <option value="Employee">Employee</option>
                                        @elseif (old('role') == 'Employee')
                                            <option value="Admin">Admin</option>
                                            <option value="Employee" selected>Employee</option>
                                        @else
                                            <option value="Admin">Admin</option>
                                            <option value="Employee">Employee</option>
                                        @endif
                                    </select>
                                    @error('role')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            <div class="form-group">
                                <label for="">Salary</label>
                                <input type="number" name="salary" value="{{ old('salary') }}" class="form-control">
                                @error('salary')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                                @error('password_confirmation')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            </fieldset>


                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-flat btn-primary"
                            style="width: 40%; font-size:1.3rem">Add</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        </div>
    </section>

@endsection
