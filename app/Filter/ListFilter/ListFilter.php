<?php

namespace App\Filter\ListFilter;

use App\Filter\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class ListFilter extends AbstractFilter
{
    public const TAGS = 'tags';
    public const NAME = 'name';

    protected function getCallbacks(): array
    {
        return [
            self::TAGS => [$this,'tags'],
            self::NAME => [$this,'name'],
        ];
    }

    protected function tags(Builder $builder,$value)
    {
        $builder->whereHas('tags', function ($query) use ($value) {

           $query->whereIn('name',$value);

        });

    }

    protected function name(Builder $builder,$value)
    {
        $builder->where('name','LIKE','%'.$value.'%');
    }
}
