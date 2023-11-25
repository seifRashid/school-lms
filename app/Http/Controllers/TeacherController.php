<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Str;


class TeacherController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getTeacher();
        $data['header_title'] = "Teacher😎 List";
        return view('admin.teacher.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add new Teacher😎";
        return view('admin.teacher.add', $data);
    }

    public function insert(Request $request)
    {
        // request()->validate() is used to validate input data submitted in an HTTP request, especially from a form input
        request()->validate([
            'email'=>'required|email|unique:users',
            'mobile_number'=>'max:20|min:10',
            'admission_number'=>'max:50|min:3'
        ]);

        $teacher = new User;
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);

        if(!empty($request->file('profile_picture')))
        {
            if(!empty($teacher->getProfile()))
            {
                unlink('upload/profile/'.$teacher->profile_pic);
            }
            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file = move('upload/profile/', $filename);

            $teacher->profile_picture = $filename;
        }

        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->profile_picture = trim($request->profile_picture);
        $teacher->email = trim($request->email);
        $teacher->password = Hash::make($request->password);
        $teacher->user_type = 2;
        $teacher->save();

        return redirect('admin/teacher/list')->with('success', "Teacher $request->name $request->last_name successfully created");

    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Student";
            return view('admin.teacher.edit', $data);
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

        $teacher = User::getSingle($id);
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->gender = trim($request->gender);

        if(!empty($request->file('profile_picture')))
        {
            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file = move('upload/profile/', $filename);

            $student->profile_picture = $filename;
        }

        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->profile_picture = trim($request->profile_picture);
        $teacher->email = trim($request->email);
        
        if(!empty($request->password))
        {
            $teacher->password = Hash::make($request->password);
        }
        $teacher->save();

        return redirect('admin/teacher/list')->with('success', "Teacher $request->name $request->last_name successfully updated");
    }

    public function delete($id)
    {
        $getRecord = User::getSingle($id);
        if(!empty($getRecord))
        {
            $getRecord->is_delete = 1;
            $getRecord->save();
            return redirect()->back()->with('success', "Teacher successfully deleted");

        }
        else
        {
            abort(404);
        }
    }
}
