<?php

namespace App\Models;

use App\Filter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lists extends Model
{
    use HasFactory,Filterable;

    protected $fillable = [
        'name',
        'image',
        'preview_image',
        'user_id',
        'status',
    ];

    public function tags():HasMany
    {
        return $this->HasMany(Tags::class,'lists_id','id');
    }

}
