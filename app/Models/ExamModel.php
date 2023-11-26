<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamModel extends Model
{
    use HasFactory;
    protected $table = 'exam';

    static public function getRecord()
    {
        return self::select('exam.*', 'users.name as created_name')
                    ->join('users', 'users.id', '=' , 'exam.created_by')
                    ->orderBy('exam.', 'desc')
                    ->paginate(50);

    }

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
