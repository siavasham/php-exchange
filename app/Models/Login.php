<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Login extends Model 
{
    public $timestamps = false;
    protected $table = 'login';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','ip','added_on'
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
