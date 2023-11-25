<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use Auth;
use Hash;
use str;

class UserController extends Controller
{
    public function myAccount()
    {
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = "My Account";
        if(Auth::user()->user_type == 1) 
        {
            return view('admin.my_account', $data);
        } 
        elseif(Auth::user()->user_type == 2) 
        {
            return view('teacher.my_account', $data);
        } 
        elseif(Auth::user()->user_type == 3)
        {
            $data['getClass'] = ClassModel::getClass();
            return view('student.my_account', $data);
        }
        elseif(Auth::user()->user_type == 5)
        {
            $data['getClass'] = ClassModel::getClass();
            return view('Headteacher.my_account', $data);
        }
        
        
    }

    public function update_MyaccountAdmin(Request $request)
    {
        $id= Auth::user()->id;
        request()->validate([
            'email'=>'required|email|unique:users,email,'.$id,
        ]);

        $admin = User::getSingle($id);
        $admin->name = trim($request->name);
        $admin->email = trim($request->email);
        
        if(!empty($request->password))
        {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();

        return redirect()->back()->with('success', "Admin $request->name successfully updated your account");

        
    }

    public function update_Myaccount(Request $request)
    {
        $id= Auth::user()->id;
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

        return redirect()->back()->with('success', "Teacher $request->name $request->last_name successfully updated");
    }

    public function update_MyaccountStudent(Request $request)
    {
        $id=Auth::user()->id;

        request()->validate([
            'email'=>'required|email|unique:users,email,'.$id,
            'mobile_number'=>'max:20|min:10',
            'admission_number'=>'max:50|min:3'
        ]);

        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->admission_number = trim($request->admission_number);
        $student->gender = trim($request->gender);

        if (!empty($request->date_of_birth)) {

            $student->date_of_birth = trim($request->date_of_birth); 
        }
        if(!empty($request->file('profile_picture')))
        {
            if(!empty($student->getProfile()))
            {
                unlink('upload/profile/'.$student->profile_picture);
            }
            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file = move('upload/profile/', $filename);
            $student->profile_picture = $filename;
        }

        $student->religion = trim($request->religion);
        $student->mobile_number = trim($request->mobile_number);
        $student->profile_picture = trim($request->profile_picture);
        $student->email = trim($request->email);
        $student->save();

        return redirect()->back()->with('success', "Student $request->name successfully updated🎉");
    }
}    
