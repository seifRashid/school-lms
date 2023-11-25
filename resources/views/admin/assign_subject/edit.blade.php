@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
          <div class="col-sm-6">
            <h1>Edit Assign Subject</h1>
          </div>
    </section>


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
                                <option {{ ($getRecord->class_id == $class->id)? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Subject Name</label>
                            @foreach ($getSubject as $subject)
                                @php
                                 $checked = ""
                                @endphp
                                @foreach ($getAssignSubjectID as $subjectAssign)
                                    @if ( $subjectAssign->subject_id == $subject->id)
                                        @php
                                         $checked = "checked";
                                        @endphp
                                    @endif
                                @endforeach
                            <div>
                                <label for="" style="font-weight:normal;">
                                    <input {{ $checked }} type="checkbox" value="{{$subject->id}}" name="subject_id[]"> {{ $subject->name }}
                                </label>
                            </div>
                            @endforeach
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" >
                            <option {{ ($getRecord->status == 0 ) ? 'selected' : '' }} value="0">Active</option>
                            <option {{ ($getRecord->status == 1 ) ? 'selected' : '' }} value="1">Inactive</option>
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