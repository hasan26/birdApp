<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Schedule
 * @package App\Models
 * @version July 4, 2017, 1:53 pm UTC
 */
class Schedule extends Model
{
    use SoftDeletes;

    public $table = 'schedules';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'description',
        'do_date',
        'status',
        'customer_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'do_date' => 'date',
        'status' => 'integer',
        'customer_id'=>'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'description' => 'required',
        'do_date' => 'required',
        'status' => 'required'
    ];

    
}
