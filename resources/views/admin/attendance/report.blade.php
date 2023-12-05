@extends('layouts.app')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1>Attendance Report (Total :{{ $getRecord->total() }}) </h1> 
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
              <h3 class="card-title">Search Attendance Report</h3>
            </div>                                    
              <form method="get" action="">           
                  <div class="card-body">             
                    <div class="row"> 
                      <div class="form-group  col-md-3">
                        <label>Student Name</label>
                        <input type="text" class="form-control" value="{{ Request::get('student_name')}}" name ="student_name" placeholder="Enter Student Name">
                      </div>                  
                      <div class="form-group   col-md-2">
                      <label>Class</label>
                          <select class="form-control" name="class_id">
                            <option value="" >Select Class</option>
                            @foreach ($getClass as $class)
                            <option {{ (Request::get('class_id') == $class->id) ? 'selected' : ''}} value="{{ $class->id }}">
                                {{$class->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group  col-md-2">
                        <label>Attendance Date</label>
                        <input type="date" class="form-control" value="{{ Request::get('attendance_date')}}" name ="attendance_date">
                      </div>
                        <div class="form-group   col-md-2">
                        <label>Attendance Type</label>
                            <select class="form-control" name="attendance_type">
                              <option value="" >Select type</option>
                              <option {{ (Request::get('attendance_type') == 1 ) ? 'selected' : ''}} value="1">Present</option>
                              <option {{ (Request::get('attendance_type') == 3 ) ? 'selected' : ''}} value="3">Absent</option>
                              <option {{ (Request::get('attendance_type') == 2 ) ? 'selected' : ''}} value="2">late</option>
                              <option {{ (Request::get('attendance_type') == 4 ) ? 'selected' : ''}} value="4">Half day</option>

                            </select>
                        </div>
                      <div class="form-group col-md-3" style="margin-top:32px">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{url('admin/attendance/report')}}" class="btn btn-success">Clear</a>
                      </div>
                    </div>
                  </div>
              </form>
            </div>
            @if(!empty(Request::get('class_id')) && !empty(Request::get('attendance_date')))
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Attendance List</h3>
              </div>
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Class Id</th>
                        <th>Student Name</th>
                        <th>Class name</th>
                        <th>Attendance</th>
                        <th>Attendance Date</th>
                        <th>Created by</th>
                        <th>Created date</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse ($getRecord as $value)
                      <tr>
                        <td>{{ $value->student_id }}</td>
                        <td>{{ $value->student_name }} {{ $value->student_last_name }}</td>
                        <td>{{ $value->class_name }}</td>
                        <td>
                          @if ( $value->attendance_type == 1 )
                            Present
                          @elseif ( $value->attendance_type == 3 )
                            Absent
                          @elseif ( $value->attendance_type == 2 )
                            Late
                          @elseif ( $value->attendance_type == 4 )
                            Half Day
                          @endif
                        </td>
                        <td>{{ date('d-m-Y',strtotime($value->attendance_date)) }}</td>
                        <td>{{ $value->created_name }}</td>
                        <td>{{ date('d-m-Y H:i A',strtotime($value->created_at)) }}</td>
                      </tr>
                        @empty
                        <tr>
                          <td colapse="100%">Record not found</td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                  <div style="padding:10px; float:right;">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                  </div>
              </div>
            </div>
            @endif
      </div>
  </section>
    
</div>


</div>
</div>
</div>

</div>

@endsection

@section('script').  
  
@endsection