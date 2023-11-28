@extends('layouts.app')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1>Student Attendance </h1> 
          </div>
          <div class="col-sm-4">
            @include('_message')
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Search Class</h3>
            </div>
              <form method="get" action="">
                  <div class="card-body">
                    <div class="row">
                      <div class="form-group  col-md-3">
                      <label>Class</label>
                          <select class="form-control" name="exam_id" required>
                            <option value="" >Select Class</option>
                            @foreach ($getClass as $class)
                            <option {{ (Request::get('class_id') == $class->id) ? 'selected' : ''}} value="{{ $class->id }}">
                                {{$class->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group  col-md-3">
                      <label>Attendance Date</label>
                        <input type="date" class="form-control" value="{{ Request::get('attendance_date')}}" name ="attendance_date" required>
                      </div>
                      <div class="form-group col-md-3" style="margin-top:32px">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{url('admin/examinations/marks_register')}}" class="btn btn-success">Clear</a>
                      </div>
                    </div>
                  </div>
              </form>
              @if(!empty($getSubject) && !empty($getSubject->count()))
          </div>
      </div>
  </section>
    
</div>


</div>
</div>
</div>

</div>

@endsection