<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model 
{
      protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','phone','status','verify'
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
    // public function tokens()
    // {
    //     return $this->hasMany(Token::class,'id','user_id');
    // }
}
