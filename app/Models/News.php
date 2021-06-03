<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class News extends Model 
{
      protected $table = 'news';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','image','desc','text','status'
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
