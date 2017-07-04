<?php

namespace App\Repositories;

use App\Models\Customer;
use InfyOm\Generator\Common\BaseRepository;

class CustomerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Customer::class;
    }
}
