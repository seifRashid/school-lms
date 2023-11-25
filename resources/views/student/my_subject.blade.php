@extends('layouts.app')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1>My Subjects </h1> 
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
                  <th>Subject name</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($getRecord as  $value)
                    <tr>
                        <td>{{ $value->subject_name }}</td>
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

@endsection