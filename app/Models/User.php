<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getAdmin()
    {
        $return = User::select('users.*')
                    ->where('user_type', '=',1)
                    ->where('is_delete', '=',0);
                    if(!empty(Request::get('name')))
                    {
                        $return = $return->where('name', 'like' , '%'.Request::get('name').'%');
                    }
                    if(!empty(Request::get('email')))
                    {
                        $return = $return->where('email', 'like' , '%'.Request::get('email').'%');
                    }
                    if(!empty(Request::get('date')))
                    {
                        $return = $return->whereDate('created_at', '=' ,Request::get('date'));
                    }
        $return = $return->orderBy('id', 'desc')
                    ->paginate(20);

        return $return;
    }


    static public function getStudent()
    {
        $return = User::select('users.*', 'class.name as class_name')
                    ->join('class', 'class.id', '=', 'users.class_id', 'left')
                    ->where('users.user_type', '=',3)
                    ->where('users.is_delete', '=',0);

                    if(!empty(Request::get('name')))
                    {
                        $return = $return->where('users.name', 'like' , '%'.Request::get('name').'%');
                    }
                    if(!empty(Request::get('last_name')))
                    {
                        $return = $return->where('users.last_name', 'like' , '%'.Request::get('last_name').'%');
                    }
                    if(!empty(Request::get('class')))
                    {
                        $return = $return->where('class.name', 'like' , '%'.Request::get('class').'%');
                    }
                    if(!empty(Request::get('admission_number')))
                    {
                        $return = $return->where('users.admission_number', 'like' , '%'.Request::get('admission_number').'%');
                    }

        $return = $return->orderBy('users.id', 'desc')
                    ->paginate(20);

        return $return;
    }

    static public function getTeacher()
    {
        $return = User::select('users.*')
                    // ->join('school', 'school.id', '=', 'users.school_id', 'left')
                    ->where('users.user_type', '=',2)
                    ->where('users.is_delete', '=',0);

                    if(!empty(Request::get('name')))
                    {
                        $return = $return->where('users.name', 'like' , '%'.Request::get('name').'%');
                    }
                    if(!empty(Request::get('last_name')))
                    {
                        $return = $return->where('users.last_name', 'like' , '%'.Request::get('last_name').'%');
                    }
                    if(!empty(Request::get('email')))
                    {
                        $return = $return->where('users.email', 'like' , '%'.Request::get('email').'%');
                    }
                    if(!empty(Request::get('gender')))
                    {
                        $return = $return->where('users.gender', 'like' , '%'.Request::get('gender').'%');
                    }
                    if(!empty(Request::get('mobile_number')))
                    {
                        $return = $return->where('users.mobile_number', 'like' , '%'.Request::get('mobile_number').'%');
                    }
    

        $return = $return->orderBy('users.id', 'desc')
                    ->paginate(20);

        return $return;
    }
    static public function getTeacherClass()
    {
        $return = User::select('users.*')
                    // ->join('school', 'school.id', '=', 'users.school_id', 'left')
                    ->where('users.user_type', '=',2)
                    ->where('users.is_delete', '=',0);
        $return = $return->orderBy('users.id', 'desc')
                    ->get();

        return $return;
    }

    //getHeadteacher function
    static public function getHeadTeacher()
    {
        $return = User::select('users.*', 'school.name as school_name')
                    ->join('school', 'school.id', '=' ,'users.school_id', 'left')
                    ->where('users.user_type', '=',5)
                    ->where('users.is_delete', '=',0);

                    if(!empty(Request::get('name')))
                    {
                        $return = $return->where('users.name', 'like' , '%'.Request::get('name').'%');
                    }
                    if(!empty(Request::get('last_name')))
                    {
                        $return = $return->where('users.last_name', 'like' , '%'.Request::get('last_name').'%');
                    }
                    if(!empty(Request::get('email')))
                    {
                        $return = $return->where('users.email', 'like' , '%'.Request::get('email').'%');
                    }
                    if(!empty(Request::get('gender')))
                    {
                        $return = $return->where('users.gender', 'like' , '%'.Request::get('gender').'%');
                    }
                    if(!empty(Request::get('mobile_number')))
                    {
                        $return = $return->where('users.mobile_number', 'like' , '%'.Request::get('mobile_number').'%');
                    }
    

        $return = $return->orderBy('users.id', 'desc')
                    ->paginate(20);

        return $return;
    }

    static public function getEmailSingle($email)
    {
        return User::where('email', '=', $email)->first(); 
    }
    static public function getTokenSingle($remember_token)
    {
        return User::where('remember_token', '=', $remember_token)->first(); 
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
    
    static public function getTeacherStudent($teacher_id)
    {
        $return = User::select('users.*', 'class.name as class_name')
                    ->join('class', 'class.id', '=', 'users.class_id')
                    ->join('assign_class_teacher', 'assign_class_teacher.class_id', '=', 'class.id')
                    ->where('assign_class_teacher.teacher_id','=',$teacher_id)
                    ->where('users.user_type', '=',3)
                    ->where('users.is_delete', '=',0);

        $return = $return->orderBy('users.id', 'desc')
                    ->groupBy('users.id')
                    ->paginate(20);

        return $return;
    }

    static public function getStudentClass($class_id)
    {
        return self::select('users.id','users.name','users.last_name')
                    ->where('users.user_type','=',3)
                    ->where('users.is_delete','=',0)
                    ->where('users.class_id','=',$class_id)
                    ->orderBy('users.id','desc')
                    ->get();
    }
}
