<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model 
{
    protected $table = 'currency';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coin','price','profit','buy','sell',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

     public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
