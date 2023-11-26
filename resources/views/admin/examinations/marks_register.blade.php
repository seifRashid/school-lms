@extends('layouts.app')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1>Marks Register </h1> 
          </div>
          <div class="col-sm-4">
            @include('_message')
          </div>
          <div class="col-sm-4" style="text-align: right;" >
            <a href="{{url('admin/class/add')}}" class="btn btn-primary">Add new Class</a>
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
                          <label>Exam</label>
                          <select class="form-control" name="exam_id" required>
                            <option value="" >Select Exam</option>
                            @foreach ($getExam as $exam)
                            <option {{ (Request::get('exam_id') == $exam_id) ? 'selected' : ''}} value="{{ $exam_id }}">
                                {{$exam->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group  col-md-3">
                      <label>Class</label>
                          <select class="form-control" name="exam_id" required>
                            <option value="" >Select Class</option>
                            @foreach ($getClass as $class)
                            <option {{ (Request::get('class_id') == $class_id) ? 'selected' : ''}} value="{{ $class_id }}">
                                {{$class->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group col-md-3" style="margin-top:32px">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{url('admin/class/list')}}" class="btn btn-success">Clear</a>
                      </div>
                    </div>
                  </div>
              </form>
          </div>
      </div>
  </section>

  <section class="content">
    
</div>


</div>
</div>
</div>

</div>

@endsection