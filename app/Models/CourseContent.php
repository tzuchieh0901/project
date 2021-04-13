<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course_content';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'course_id',
        'content_sequence',
        'content_chapter_name',
        'video',
        'content',
    ];
}
