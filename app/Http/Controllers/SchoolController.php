<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolModel;


class SchoolController extends Controller
{
    public function list()
    {
        $data['getRecord'] = SchoolModel::getRecord();

        $data['header_title'] = "School list";
        return view('admin.school.list', $data);
    }
    public function add()
    {
        $data['header_title'] = "add new School";
        return view('admin.school.add', $data);
    }
    public function insert(Request $request)
    {
        $school = new SchoolModel;
        $school->name = trim($request->name);
        $school->location = trim($request->location);

        if(!empty($request->file('profile_picture')))
        {
            if(!empty($school->getProfile()))
            {
                unlink('upload/profile/'.$school->profile_pic);
            }
            $ext = $request->file('profile_picture')->getClientOriginalExtension();
            $file = $request->file('profile_picture');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file = move('upload/profile/', $filename);

            $school->profile_picture = $filename;
        }

        $school->save();

        return redirect('admin/school/list')->with('success', "{$school->name} Successfully Created 🥰🚀");
    }

    public function edit($id)
    {
        $data['getRecord'] = SchoolModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit school";
            return view('admin.school.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        $school = SchoolModel::getSingle($id);
        $school->name = trim($request->name);
        $school->location = trim($request->location);
        $school->save();

        return redirect('admin/school/list')->with('success', "{$school->name} Successfully Updated 🥰🚀");
    }

    public function delete($id, Request $request)
    {
        $save = SchoolModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect()->back()->with('success', "{$save->name} Successfully Deleted 🥰🚀");
    }
}
