@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
          <div class="col-sm-6">
            <h1>My Account👨</h1>
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
                            <input type="text" class="form-control" name="name" value="{{ old('name', $getRecord->name) }}" required placeholder="Enter first name">
                            <div style="color:red;">{{ $errors->first('name') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Second Name <span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $getRecord->last_name) }}" required placeholder="Enter last name">
                            <div style="color:red;">{{ $errors->first('last_name') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Admission Number <span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="admission_number" value="{{ old('admission_number', $getRecord->admission_number ) }}" required placeholder="Enter admission number">
                            <div style="color:red;">{{ $errors->first('admission_number') }}</div>
                            
                        </div>
                        <div class="form-group col-md-6">
                            <label>Select Class <span style="color:red">*</span></label>
                            <select class="form-control" name="class_id">
                                <option value="">Select Class</option>
                                @if ($getClass)
                                    @foreach ($getClass as $value)
                                    <option {{ (old('class_id', $getRecord->class_id) == $value->id) ? 'selected' : '' }} value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div style="color:red;">{{ $errors->first('class_id') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Gender <span style="color:red">*</span></label>
                            <select class="form-control" required name="gender">
                                <option value="">Select Gender</option>
                                <option {{ (old('gender', $getRecord->gender) == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                <option {{ (old('gender', $getRecord->gender) == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                            </select>
                            <div style="color:red;">{{ $errors->first('gender') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Date of Birth <span style="color:red">*</span></label>
                            <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $getRecord->date_of_birth) }}" required>
                            <div style="color:red;">{{ $errors->first('date_of_birth') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Religion <span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="religion" value="{{ old('religion', $getRecord->religion) }}" required placeholder="Enter your religion">
                            <div style="color:red;">{{ $errors->first('religion') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Parent mobile no. <span style="color:red">*</span></label>
                            <input type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number', $getRecord->mobile_number) }}" required placeholder="Enter mobile number">
                            <div style="color:red;">{{ $errors->first('mobile_number') }}</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Profile picture</label>
                            <input type="file" class="form-control" name="profile_picture">
                            <div style="color:red;">{{ $errors->first('profile_picture') }}</div>
                            @if (!empty($getRecord->getProfile()))
                                <img src="{{ $getRecord->getProfile() }}" style="width: 100px;">
                            @endif
                        </div>
                    </div>

                    <hr/>

                    <div class="form-group">
                        <label>Email address <span style="color:red">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $getRecord->email) }}" required placeholder="Enter email">
                        <div style="color:red;">{{ $errors->first('email') }}</div>
                    </div>
                    <div class="form-group">
                        <label>Password <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="password" required placeholder="Password">
                        <p>You can also change password if needs be</p>
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