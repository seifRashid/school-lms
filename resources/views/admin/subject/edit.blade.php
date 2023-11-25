@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
          <div class="col-sm-6">
            <h1>Edit Subject</h1>
          </div>
    </section>


    <div class="container-fluid mt-2">
        <div class="card card-primary">
            <form method="post" action="">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label>Subject Name</label>
                        <input type="text" class="form-control" name="name" required value = "{{ $getRecord->name }}">
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" id="" class="form-control" required>
                            <option value="">Select type</option>
                            <option {{ ($getRecord->type == 'Theory')? 'selected' : '' }} value="Theory">Theory</option>
                            <option {{ ($getRecord->type == 'Practical')? 'selected' : '' }} value="Practical">Practical</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="" class="form-control">
                            <option {{ ($getRecord->status == 0)? 'selected' : '' }} value="0">Active</option>
                            <option {{ ($getRecord->status == 1)? 'selected' : '' }} value="1">Inactive</option>
                        </select>
                    </div>
                    
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection