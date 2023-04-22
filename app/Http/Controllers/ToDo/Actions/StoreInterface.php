<?php

namespace App\Http\Controllers\ToDo\Actions;

interface StoreInterface
{
    public function handle(object $model,array $data):void;
}
