<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherCourse extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'teacher_course';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'teacher_id',
        'course_id',
    ];
}
