@extends('layouts.userLayout')

@section('content')

    <div class="container">
        <div class="col-lg-6 col-md-8 mx-auto">
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="text-center mt-2">User Profile for : {{ $user->name }}</h5>
                </div>
                @include('alerts')

                <form action="{{ route('employee.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">

                        <fieldset>

                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" id="photo" name="photo" class="form-control">
                                @error('photo')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

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
                        </fieldset>


                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-flat btn-primary"
                            style="width: 40%; font-size:1.3rem">Update</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection
