<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model 
{
    protected $table = 'wallet';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','coin',
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
    public function address()
    {
        return $this->hasMany(Address::class,'id','wallet_id');
    }
    // public function price()
    // {
    //     return $this->hasOne(Coin::class,'name','coin');
    // }
}
