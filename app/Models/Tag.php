<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tag
 * @package App\Models
 * @version June 22, 2017, 1:47 pm UTC
 */
class Tag extends Model
{
    use SoftDeletes;

    public $table = 'tags';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required'
    ];

    
}
