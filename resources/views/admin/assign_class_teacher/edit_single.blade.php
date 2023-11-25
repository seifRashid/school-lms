@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
          <div class="col-sm-6">
            <h1>Edit Assign Teacher to Class/Classes</h1>
          </div>
    </section>
    @include('_message')

    <div class="container-fluid mt-2">
        <div class="card card-primary">
            <form method="post" action="">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label>Class Name</label>
                        <select name="class_id" id="" class="form-control" required>
                            <option value="">Select Class</option> 
                            @foreach ($getClass as $class)
                                <option {{($getRecord->class_id == $class->id)? 'selected' : ''}} value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Teacher Name</label>
                        <select name="teacher_id" id="" class="form-control" required>
                            <option value="">Select Teacher</option> 
                            @foreach ($getTeacher as $teacher)  
                                <option {{($getRecord->teacher_id == $teacher->id)? 'selected' : ''}} value="{{ $class->id }}">{{ $teacher->name }} {{ $teacher->last_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection