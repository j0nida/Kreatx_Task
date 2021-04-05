@extends('layouts.adminLayout')

@section('content')

    <div class="container" >
            <div class="col-lg-6 col-md-8 mx-auto">
                <div class="card card-primary">
                    <div class="card-header">
                        <h5 class="text-center mt-2">Department : {{$department->name}}</h5>
                    </div>
                    <form action="{{ route('admin.dept.update', $department->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="card-body">
                        
                            <fieldset>
                                <div class="form-group">
                                    <label for="name">Department Name</label>
                                    <input type="text" id ="name" name="name" value="{{ $department->name }}" class="form-control">
                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="desc">Department Description</label>
                                    <input type="string" id ="desc" name="desc" value="{{ $department->description }}" class="form-control">
                                    @error('desc')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                            </fieldset>
                            
                        
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-flat btn-primary" style="width: 40%; font-size:1.3rem">Save</button>
                    </div>
                </form>
                </div>
            </div>
        
    </div>
    
@endsection