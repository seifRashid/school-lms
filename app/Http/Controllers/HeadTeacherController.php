<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolModel;
use App\Models\User;
use Hash;
use Auth;
use Str;

class HeadTeacherController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getHeadTeacher();
        $data['header_title'] = "Head Teacher😎 List";
        return view('admin.headTeacher.list', $data);
    }

    public function add()
    {
        $data['getSchool'] = SchoolModel::getSchool();
        $data['header_title'] = "Add new Head Teacher😎";
        return view('admin.headTeacher.add', $data);
    }

    public function insert(Request $request)
    {
        // request()->validate() is used to validate input data submitted in an HTTP request, especially from a form input
        request()->validate([
            'email'=>'required|email|unique:users',
            'mobile_number'=>'max:20|min:10',
            'admission_number'=>'max:50|min:3'
        ]);

        $headTeacher = new User;
        $headTeacher->name = trim($request->name);
        $headTeacher->last_name = trim($request->last_name);
        $headTeacher->school_id = trim($request->school_id);
        $headTeacher->gender = trim($request->gender);

        if(!empty($request->file('profile_picture')))
        {
            if(!empty($headTeacher->getProfile()))
            {
                unlink('upload/profile/'.$headTeacher->profile_pic);
            }
            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file = move('upload/profile/', $filename);

            $headTeacher->profile_picture = $filename;
        }

        $headTeacher->mobile_number = trim($request->mobile_number);
        $headTeacher->profile_picture = trim($request->profile_picture);
        $headTeacher->email = trim($request->email);
        $headTeacher->password = Hash::make($request->password);
        $headTeacher->user_type = 5;
        $headTeacher->save();

        return redirect('admin/Headteacher/list')->with('success', "Head Teacher $request->name $request->last_name successfully created");

    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['getSchool'] = SchoolModel::getSchool();
            $data['header_title'] = "Edit Head Teacher";
            return view('admin.Headteacher.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id,Request $request)
    {
        request()->validate([
            'email'=>'required|email|unique:users,email,'.$id,
            'mobile_number'=>'max:20|min:10',
            'admission_number'=>'max:50|min:3'
        ]);

        $headTeacher = User::getSingle($id);
        $headTeacher->name = trim($request->name);
        $headTeacher->last_name = trim($request->last_name);
        $headTeacher->school_id = trim($request->school_id);
        $headTeacher->gender = trim($request->gender);

    
        if(!empty($request->file('profile_picture')))
        {
            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file = move('upload/profile/', $filename);

            $headTeacher->profile_picture = $filename;
        }

        $headTeacher->mobile_number = trim($request->mobile_number);
        $headTeacher->profile_picture = trim($request->profile_picture);
        $headTeacher->email = trim($request->email);
        
        if(!empty($request->password))
        {
            $headTeacher->password = Hash::make($request->password);
        }
        $headTeacher->save();

        return redirect('admin/Headteacher/list')->with('success', "$request->name successfully updated");
    }

    public function delete($id,Request $request )
    {
        $getRecord = User::getSingle($id);
        if(!empty($getRecord))
        {
            $getRecord->is_delete = 1;
            $getRecord->save();
            return redirect()->back()->with('success', "Head Teacher successfully deleted");

        }
        else
        {
            abort(404);
        }
    }

}
