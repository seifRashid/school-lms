@extends('layouts.app')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1>Assign Subject list </h1> 
          </div>
          <div class="col-sm-4">
            @include('_message')
          </div>
          <div class="col-sm-4" style="text-align: right;" >
            <a href="{{url('admin/assign_subject/add')}}" class="btn btn-primary">Add new Assign Subject</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Search Assign Subject</h3>
            </div>
              <form method="get" action="">
                  <div class="card-body">
                    <div class="row">
                      <div class="form-group  col-md-3">
                          <label>Class Name</label>
                          <input type="text" class="form-control" name="class_name" value="{{Request::get('class_name')}}" placeholder="Enter class name">
                      </div>
                      <div class="form-group  col-md-3">
                          <label>Subject Name</label>
                          <input type="text" class="form-control" name="subject_name" value="{{Request::get('subject_name')}}" placeholder="Enter subject name">
                      </div>
                      <div class="form-group  col-md-3">
                          <label>Date</label>
                          <input type="date" class="form-control" name="date" value="{{Request::get('date')}}" placeholder="Enter date">
                      </div>
                      <div class="form-group col-md-3" style="margin-top:32px">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{url('admin/assign_subject/list')}}" class="btn btn-success">Clear</a>
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
                  <th>Classs Name</th>
                  <th>Subject Name</th>
                  <th>Status</th>
                  <th>Created by</th>
                  <th>Created at</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
               @foreach ($getRecord as $value)
                 <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->class_name }}</td>
                    <td>{{ $value->subject_name }}</td>
                    <td>
                      @if ($value->status == 0)
                        Active
                      @else
                        Inactive
                      @endif
                    </td>
                    <td>{{ $value->created_by_name }}</td>
                    <td>{{ date('d-m-y H:i A', strtotime($value->created_at)) }}</td>
                    <td>
                      <a href="{{url('admin/assign_subject/edit/'.$value->id)}}" class="btn btn-success mr-2">Edit</a>
                      <a href="{{url('admin/assign_subject/edit_single/'.$value->id)}}" class="btn btn-info mr-2">Edit Single</a>
                      <a href="{{url('admin/assign_subject/delete/'.$value->id)}}" class="btn btn-danger">Delete</a> 
                    </td>
                 </tr>
               @endforeach
              </tbody>
            </table>
            <div style="padding:10px; float:right;">
              {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
            </div>
          </div>
        </div>
  </div>
</div>


</div>
</div>
</div>

</div>

@endsection