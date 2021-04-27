<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model 
{
    protected $table = 'faq';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question','answer'
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
