<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model 
{
    public $timestamps = false;
    protected $table = 'banks';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','code','card','number','iban','image','video'
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
