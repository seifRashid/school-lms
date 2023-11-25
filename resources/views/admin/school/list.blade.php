@extends('layouts.app')

@section('content')


<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1>School's list (Total:{{ $getRecord->total() }})</h1>
          </div>
          <div class="col-sm-4">
            @include('_message')
          </div>
          <div class="col-sm-4" style="text-align: right;" >
            <a href="{{url('admin/school/add')}}" class="btn btn-primary">Add new School</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
  </section>

  
  <section class="content">
    <div class="container-fluid">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Search School</h3>
            </div>
              <form method="get">
                  <div class="card-body">
                    <div class="row">
                      <div class="form-group  col-md-2">
                          <label>School Name</label>
                          <input type="text" class="form-control" name="name" value="{{Request::get('name')}}" placeholder="Enter name">
                      </div>
                      <div class="form-group  col-md-2">
                          <label>Location</label>
                          <input type="text" class="form-control" name="location" value="{{Request::get('location')}}" placeholder="Enter Adm No.">
                      </div>
                      <div class="form-group col-md-3" style="margin-top:32px">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{url('admin/teacher/list')}}" class="btn btn-success">Clear</a>
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
          <div class="card-body container-fluid">
            <div style="overflow:auto;">

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Profile picture</th>
                    <th>School Name</th>
                    <th>Location</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($getRecord as $value)
                  <tr>
                    <td>{{ $value->id }}</td>
                    <td>
                      @if (!empty($value->getProfile()))
                      <img src="{{ $value->getProfile() }}" style="height:50px; width:50px; border-radius:50px;">
                      @endif
                    </td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->location }}</td>
                    <td style="min-width:140px;">
                      <a href="{{url('admin/school/edit/'.$value->id)}}" class="btn btn-success mr-2 btn-sm">Edit</a>
                      <a href="{{url('admin/school/delete/'.$value->id)}}" class="btn btn-danger btn-sm">Delete</a> 
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <!-- the connector to bootsrap in in the AppServiceProvider -->
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