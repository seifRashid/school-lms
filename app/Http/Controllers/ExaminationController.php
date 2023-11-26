<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\ExamModel;


class ExaminationController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getAdmin();
        $data['header_title'] = "Admin😎 List";
        return view('admin.admin.list', $data);
    }
    
    public function marks_register()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = ExamModel::getExam();
        $data['header_title'] = "Marking Register";
        return view('admin.examinations.marks_register',$data);
    }

}
