<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model 
{
    public $timestamps = false;
    protected $table = 'plans';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type','profit','invest'
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
