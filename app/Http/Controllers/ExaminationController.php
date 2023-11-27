<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\ClassModel;
use App\Models\ExamModel;


class ExaminationController extends Controller
{
    public function exam_list()
    {
        $data['getRecord'] = ExamModel::getRecord();
        $data['header_title'] = "Exam List";
        return view('admin.examinations.exam.list', $data);
    }

    public function exam_add()
    {
        $data['header_title'] = "Exam List";
        return view('admin.examinations.exam.add', $data);
    }

    public function exam_insert(Request $request)
    {
        $exam = new ExamModel;
        $exam->name = trim($request->name);
        $exam->note = trim($request->note);
        $exam->created_by = Auth::user()->id;
        $exam->save();

        return redirect()->back()->with('success', "Exam successfully created");

    }

    public function marks_register()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = ExamModel::getExam();
        $data['header_title'] = "Marking Register";
        return view('admin.examinations.marks_register',$data);
    }

}
