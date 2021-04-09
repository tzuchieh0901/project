<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses()
    {
        return $this->belongsToMany(
            Course::class,
            'student_course',
            'student_id',
            'course_id'
        );
    }

     /**
     * 回傳使用者放入購物車的課程
     *
     * @return array
     */
    public function cart()
    {
        return $this->belongsToMany(
            Course::class,
            'cart',
            'user_id',
            'course_id'
        )->withPivot('id');
    }
}
