<?php

namespace App\Http\Controllers;

use Core\Base\BaseController;
use Core\Person\PersonRepo;

class PersonController extends BaseController
{
    public function __construct(PersonRepo $model)
    {
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|string|email|unique:people',
            'phone' => 'required|string',
            'birth_date' => 'required|date',
        ];
        $searchable = [
            'first_name',
            'last_name',
            'address',
            'email',
            'phone',
            'birth_date'
        ];

        parent::__construct($model, $rules, $searchable);
    }
}
