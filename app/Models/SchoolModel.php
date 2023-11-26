<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;


class SchoolModel extends Model
{
    use HasFactory;

    protected $table = 'school';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getRecord()
    {
        $return = SchoolModel::select('school.*');
                    
                    $return = $return->where('school.is_delete', '=', 0 )
                    ->orderBy('school.id', 'desc')
                    ->paginate(20);

        return $return;
    }
    
    public function getProfile()
    {
        if(!empty($this->profile_picture) && file_exists('upload/profile/'.$this->profile_picture))
        {
            return url('upload/profile/'.$this->profile_picture);
        }
        else
        {
            return "";
        }
    }
//Trying purpose
    static public function getSchool()
    {
        $return = SchoolModel::select('school.*')
        ->where('school.is_delete', '=', 0 )
        ->orderBy('school.name', 'asc')
        ->get();

        return $return;
    }
}
