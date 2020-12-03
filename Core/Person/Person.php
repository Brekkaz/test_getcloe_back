<?php

namespace Core\Person;

use Core\Base\BaseEntity;

class Person extends BaseEntity
{
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'email',
        'phone',
        'birth_date'
    ];
}
