<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use DB;
class Referral extends Model 
{
    protected $table = 'referral';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','referral'
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
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
