<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'course';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'outline',
        'price',
        'image',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'outline' => '',
    ];

    /**
     * 課程的老師
     *
     * @return array
     */
    public function teacher()
    {
        return $this->belongsToMany(
            User::class,
            'teacher_course',
            'course_id',
            'teacher_id'
        );
    }
}
