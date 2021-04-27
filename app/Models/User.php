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
        'name','email','password','lang'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->password = md5($model->password);
        });
    }
}
