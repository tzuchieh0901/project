<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'purchase_record';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'course_id',
        'course_name',
        'price',
    ];
}
