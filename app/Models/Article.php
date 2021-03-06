<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Article
 * @package App\Models
 * @version June 22, 2017, 1:33 pm UTC
 */
class Article extends Model
{
    use SoftDeletes;

    public $table = 'articles';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'image',
        'text',
        'tag',
        'bundle_articles',
        'is_banner'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'image' => 'string',
        'text' => 'string',
        'tag' => 'string',
        'bundle_articles'=> 'string',
        'is_banner'=>'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'image' => 'required',
        'text' => 'required',
        'tag' => 'required'
    ];

    
}
