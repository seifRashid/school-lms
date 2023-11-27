@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
          <div class="col-sm-6">
            <h1>Add New Exam</h1>
          </div>
    </section>


    <div class="container-fluid mt-2">
        <div class="card card-primary">
            <form method="post">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label>Exam Name</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required placeholder="Enter Exam name">
                    </div>
                    <div class="form-group">
                        <label>Note</label>
                        <textarea name="note" class="form-control" placeholder="Note" cols="30" rows="10"></textarea>
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