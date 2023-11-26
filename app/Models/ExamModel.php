<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamModel extends Model
{
    use HasFactory;
    protected $table = 'exams';

    static public function getExam()
    {
        $return = self::select('exam.*')
                    ->join('users', 'users.id', 'exam.created_by')
                    ->where('exam.is_delete', '=', 0 )
                    ->orderBy('exam.name', 'asc')
                    ->get();

        return $return;
    }
}
