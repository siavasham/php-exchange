<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Coin extends Model 
{
    public $timestamps = false;
    protected $table = 'coins';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','fullname','dname','price','balance','status'
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
