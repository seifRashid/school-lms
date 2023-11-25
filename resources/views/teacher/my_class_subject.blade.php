@extends('layouts.app')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1>My class and Subject </h1> 
          </div>
          <div class="col-sm-4">
            @include('_message')
          </div>
        </div>
      </div><!-- /.container-fluid -->
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
                  <th>Created Date</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($getRecord as $value)
                  <tr>
                      <td>{{ $value->id }}</td>
                      <td>{{ $value->class_name }}</td>
                      <td>{{ $value->subject_name }}</td>
                      <td>{{ date('d-m-y H:i A', strtotime($value->created_at)) }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            
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