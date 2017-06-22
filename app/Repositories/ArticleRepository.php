<?php

namespace App\Repositories;

use App\Models\Article;
use InfyOm\Generator\Common\BaseRepository;

class ArticleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'image',
        'text',
        'tag'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Article::class;
    }
}
