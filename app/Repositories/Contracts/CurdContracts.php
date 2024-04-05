<?php

namespace App\Repositories\contracts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface CurdContracts
{
    function all();
    function show(Model $model);
    function process($data);
    
}
