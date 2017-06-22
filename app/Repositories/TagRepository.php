<?php

namespace App\Repositories;

use App\Models\Tag;
use InfyOm\Generator\Common\BaseRepository;

class TagRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Tag::class;
    }
}
