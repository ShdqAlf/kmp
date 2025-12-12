<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the types associated with the category.
     */
    public function type()
    {
        return $this->hasOne(Type::class, 'category_id');
    }
}
