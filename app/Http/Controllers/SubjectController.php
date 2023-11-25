<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubjectModel;
use App\Models\ClassSubjectModel;
use Auth;


class SubjectController extends Controller
{
    public function list()
    {
        $data['getRecord'] = SubjectModel::getRecord();

        $data['header_title'] = "subject list";
        return view('admin.subject.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "add new subject";
        return view('admin.subject.add', $data);
    }

    public function insert(Request $request)
    {
        $save = new SubjectModel;
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
        $save->created_by = Auth::user()->id;
        $save->save();

        return redirect('admin/subject/list')->with('success', "{$save->name} Successfully Created 🥰🚀");
    }
    public function edit($id)
    {
        $data['getRecord'] = SubjectModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit subject";
            return view('admin.subject.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        $save = SubjectModel::getSingle($id);
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
        $save->save();

        return redirect('admin/subject/list')->with('success', "{$save->name} Successfully Updated 🥰🚀");
    }

    public function delete($id, Request $request)
    {
        $save = SubjectModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect()->back()->with('success', "{$save->name} Successfully Deleted 🥰🚀");
    }


    //Student part
    public function MySubject()
    {
        $data['getRecord'] = ClassSubjectModel::MySubject(Auth::user()->class_id);
        $data['header_title'] = "My subjects";
        return view('student.my_subject', $data);
    }
}
