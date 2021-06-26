<?php

namespace App\Services;

use phpDocumentor\Reflection\Types\Boolean;

interface RandomUserApiContract
{
    public function request() : array;
    public function save($data): bool;
}
