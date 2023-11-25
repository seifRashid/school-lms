@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
          <div class="col-sm-6">
            <h1>Add New School</h1>
          </div>
    </section>


    <div class="container-fluid mt-2">
        <div class="card card-primary">
            <form method="post" action="">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label>School Name</label>
                        <input type="text" class="form-control" name="name" required placeholder="Enter Subject name">
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" class="form-control" name="location" required placeholder="Enter Subject name">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Profile picture</label>
                        <input type="file" class="form-control" name="profile_picture">
                        <div style="color:red;">{{ $errors->first('profile_picture') }}</div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection