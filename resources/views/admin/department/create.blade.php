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
                   
                    <form action="{{route('department.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                    <div class="card-body">
                        
                            <fieldset>
                                <div class="form-group">
                                    <label for="">Department Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}"  class="form-control">
                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <input type="text" name="description" value="{{ old('description') }}" class="form-control">
                                    @error('description')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                               
                                
                                <div class="form-group">
                                        <label for="">Parent Department</label>
                                        <select name="department_id" class="form-control">
                                            <option hidden disabled selected value> -- select an option -- </option>
                                            <option value = ""> Parent Department </option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    @if (old('department_id') == $department->id)
                                                        selected
                                                    @endif    
                                                >
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
                                </div>
                                
                            </fieldset>
                            
                        
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-flat btn-primary" style="width: 40%; font-size:1.3rem">Add</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        
    </div>
</section>
    
@endsection