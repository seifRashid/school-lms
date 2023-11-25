@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
          <div class="col-sm-6">
            <h1>Add New Head Teacher</h1>
          </div>
    </section>


    <div class="container-fluid mt-2">
        <div class="card card-primary">
            <form method="post" action="" ecntype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>First Name <span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required placeholder="Enter first name">
                            <div style="color:red;">{{ $errors->first('name') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Second Name <span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required placeholder="Enter last name">
                            <div style="color:red;">{{ $errors->first('last_name') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Select School <span style="color:red">*</span></label>
                            <select class="form-control" required name="school_id">
                                <option value="">Select School</option>
                                @foreach ($getSchool as $value)
                                <option {{ (old('school_id') == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                            <div style="color:red;">{{ $errors->first('school_id') }}</div>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label>Gender <span style="color:red">*</span></label>
                            <select class="form-control" required name="gender">
                                <option value="">Select Gender</option>
                                <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                            </select>
                            <div style="color:red;">{{ $errors->first('gender') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Mobile Number <span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number') }}" required placeholder="Enter mobile number">
                            <div style="color:red;">{{ $errors->first('mobile_number') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Profile picture</label>
                            <input type="file" class="form-control" name="profile_picture">
                            <div style="color:red;">{{ $errors->first('profile_picture') }}</div>
                        </div>
                    </div>

                    <hr/>

                    <div class="form-group">
                        <label>Email address <span style="color:red">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Enter email">
                        <div style="color:red;">{{ $errors->first('email') }}</div>
                    </div>
                    <div class="form-group">
                        <label>Password <span style="color:red">*</span></label>
                        <input type="password" class="form-control" name="password" required placeholder="Password">
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