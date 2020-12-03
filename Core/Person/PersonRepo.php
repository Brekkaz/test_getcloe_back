<?php
namespace Core\Person;

use Core\Base\BaseRepoAll;

class PersonRepo extends BaseRepoAll
{
    public function getModel()
    {
        return new Person();
    }
}

