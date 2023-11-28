@extends('layouts.app')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1>Admin list</h1>
          </div>
          <div class="col-sm-4">
            @include('_message')
          </div>
          <div class="col-sm-4" style="text-align: right;" >
            <a href="{{url('admin/examinations/exam/add')}}" class="btn btn-primary">Add new Exam</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Search Exam Schedule</h3>
            </div>
              <form method="get" action="">
                  <div class="card-body">
                    <div class="row">
                      <div class="form-group  col-md-3">
                          <label>Exam Name</label>
                          <select name="exam_id" class="form-control" required>
                            <option value="">Select</option>
                            @foreach ($getExam as $exam)
                             <option {{ (Request::get('exam_id') == $exam->id) ? 'selected':'' }} value="{{ $exam->id}}">{{ $exam->name}}</option>                              
                            @endforeach
                          </select>
                      </div>

                      <div class="form-group  col-md-3">
                          <label>Class</label>
                          <select name="class_id" class="form-control" required>
                            <option value="">Select</option>
                            @foreach ($getClass as $class)
                             <option {{ (Request::get('class_id') == $class->id) ? 'selected':'' }} value="{{ $class->id}}">{{ $class->name}}</option>                              
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group col-md-3" style="margin-top:32px">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{url('admin/examinations/exam_schedule')}}" class="btn btn-success">Clear</a>
                      </div>
                    </div>
                  </div>
              </form>
          </div>
      </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Exam Name</th>
                  <th>Note</th>
                  <th>Created By</th>
                  <th>Created at</th>
                  <th>Actions</th>
                </tr>
              </thead>
              
            </table>

            <!-- the connector to bootsrap in in the AppServiceProvider -->
          </div>
        </div>
  </div>
</div>


</div>
</div>
</div>

</div>

@endsection