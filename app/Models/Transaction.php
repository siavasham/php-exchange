<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model 
{
    protected $table = 'transaction';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'user_id','coin','address','amount','type','data'
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
