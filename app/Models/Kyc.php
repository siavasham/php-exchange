<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Kyc extends Model 
{
    protected $table = 'kyc';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','cart','img', 'status'
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
