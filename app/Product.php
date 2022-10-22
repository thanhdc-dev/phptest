<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'price',
        'image_path',
    ];

    function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setPerPage(2);
    }
}
