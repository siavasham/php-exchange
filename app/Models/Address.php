<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Address extends Model 
{
    protected $table = 'address';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'wallet_id','address',
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
    public function wallet()
    {
        return $this->belongsTo(Wallet::class,'wallet_id','id');
    }
}
