<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\ClassModel;
use App\Models\ExamModel;
use App\Models\ClassSubjectModel;


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

        return redirect('admin/examinations/exam/list')->with('success', "Exam successfully created");

    }

    public function marks_register()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = ExamModel::getExam();
        if(!empty($request->get('exam_id')) && !empty($request->get('exam_id')))
        {

        }
        $data['header_title'] = "Marking Register";
        return view('admin.examinations.marks_register',$data);
    }

    public function exam_edit($id)
    {
        $data['getRecord'] = ExamModel::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['header_title'] = "Edit Exam";
            return view('admin.examinations.exam.edit', $data); 
        }
        else
        {
            abort(404);
        }
    }

    public function exam_update($id, Request $request)
    {
        $exam = ExamModel::getSingle($id);;
        $exam->name = trim($request->name);
        $exam->note = trim($request->note);
        $exam->save();

        return redirect('admin/examinations/exam/list')->with('success', "Exam successfully Updated");

    }

    public function exam_delete($id)
    {
        $getRecord = ExamModel::getSingle($id);
        if(!empty($getRecord))
        {
            $getRecord->is_delete = 1;
            $getRecord->save();

            return redirect()->back()->with('success', "Exam successfully deleted");
        }
        else
        {
            abort(404);
        }
    }

    public function exam_schedule(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = ExamModel::getExam();

        $result = array();
        if(!empty($request->get('exam_id')) && !empty($request->get('class_id')) )
        {
            $getSubject = ClassSubjectModel::MySubject($request->get('class_id'));
            foreach($getSubject as $value)
            {
                $dataS = array();
                $dataS['subject_id'] = $value->subject_id;
                $dataS['class_id'] = $value->class_id;
                $dataS['subject_name'] = $value->subject_name;
                $result[] = $dataS;
            }
        }
        dd($result);

        $data['header_title'] = "Edit Schedule";
        return view('admin.examinations.exam_schedule', $data);
    }
}
