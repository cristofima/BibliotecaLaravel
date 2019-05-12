<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name', 'author', 'number_pages', 'available',
    ];

    public function loans()
    {
        return $this->hasMany('App\Loan');
    }
}
