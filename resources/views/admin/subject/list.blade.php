@extends('layouts.app')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1>Subject list </h1> 
          </div>
          <div class="col-sm-4">
            @include('_message')
          </div>
          <div class="col-sm-4" style="text-align: right;" >
            <a href="{{url('admin/subject/add')}}" class="btn btn-primary">Add new Subject</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container-fluid">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Search subject</h3>
            </div>
              <form method="get" action="">
                  <div class="card-body">
                    <div class="row">
                      <div class="form-group  col-md-3">
                          <label>Name</label>
                          <input type="text" class="form-control" name="name" value="{{Request::get('name')}}" placeholder="Enter name">
                      </div>
                      <div class="form-group  col-md-3">
                        <label>Select Type</label>
                        <select name="type" id="" class="form-control">
                            <option value="">Select type</option>
                            <option {{(Request::get('type') == "Theory")? 'selected':''}} value="Theory">Theory</option>
                            <option {{(Request::get('type') == "Practical")? 'selected':''}} value="Practical">Practical</option>
                        </select>
                      </div>
                      <div class="form-group  col-md-3">
                          <label>Date</label>
                          <input type="date" class="form-control" name="date" value="{{Request::get('date')}}" placeholder="Enter date">
                      </div>
                      <div class="form-group col-md-3" style="margin-top:32px">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{url('admin/subject/list')}}" class="btn btn-success">Clear</a>
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
                  <th>Subject name</th>
                  <th>Subject type</th>
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
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->type }}</td>
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
                      <a href="{{url('admin/subject/edit/'.$value->id)}}" class="btn btn-success mr-2">Edit</a>
                      <a href="{{url('admin/subject/delete/'.$value->id)}}" class="btn btn-danger">Delete</a> 
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