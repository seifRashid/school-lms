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
                      <div class="form-group   col-md-3">
                      <label>Class</label>
                          <select class="form-control" name="class_id" id="getClass" required>
                            <option value="" >Select Class</option>
                            @foreach ($getClass as $class)
                            <option {{ (Request::get('class_id') == $class->id) ? 'selected' : ''}} value="{{ $class->id }}">
                                {{$class->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group  col-md-3">
                      <label>Attendance Date</label>
                        <input type="date" class="form-control" id="getAttendanceDate" value="{{ Request::get('attendance_date')}}" name ="attendance_date" required>
                      </div>
                      <div class="form-group col-md-3" style="margin-top:32px">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{url('admin/examinations/marks_register')}}" class="btn btn-success">Clear</a>
                      </div>
                    </div>
                  </div>
              </form>
            </div>
            @if(!empty(Request::get('class_id')) && !empty(Request::get('attendance_date')))
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Students List</h3>
              </div>
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Class Id</th>
                        <th>Student Name</th>
                        <th>Attendance</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(!empty($getStudent) && !empty($getStudent->count())) 
                        @foreach ($getStudent as $value)
                          <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->name}} {{$value->last_name}}</td>
                            <td>
                              <label><input type="radio" value="1" id="{{$value->id}}" class="SaveAttendance" name="attendance{{$value->id}}">  Present</label>
                              <label><input type="radio" value="3" id="{{$value->id}}" class="SaveAttendance" name="attendance{{$value->id}}">  Absent</label>
                              <label><input type="radio" value="2" id="{{$value->id}}" class="SaveAttendance" name="attendance{{$value->id}}">  Late</label>
                              <label><input type="radio" value="4" id="{{$value->id}}" class="SaveAttendance" name="attendance{{$value->id}}">  Half Day</label>
                            </td>
                          </tr>   
                        @endforeach
                      @endif
                    </tbody>
                  </table>
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
  <script type="text/javascript">
    $('.SaveAttendance').change(function(e)
    {
      var student_id = $(this).attr('id');
      var attendance_type = $(this).val();
      var class_id = $('#getClass').val();
      var attendance_date = $('#getAttendanceDate').val();

      $.ajax(
    {
        type:"POST",
        url:"{{ url('admin/attendance/student/save') }}",
        data:{
          "_token": "{{ csrf_token() }}",
          student_id : student_id,
          attendance_type : attendance_type,
          class_id : class_id,
          attendance_date : attendance_date,
      },
      dataType:"json",
      success: function(data){
            alert(data.message);
      }
    });
    });
  </script>
@endsection