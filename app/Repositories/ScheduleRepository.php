<?php

namespace App\Repositories;

use App\Models\Schedule;
use InfyOm\Generator\Common\BaseRepository;

class ScheduleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'do_date',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Schedule::class;
    }
}
