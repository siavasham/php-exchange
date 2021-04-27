<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TicketMsg extends Model 
{
    public $timestamps = false;
    protected $table = 'ticket_msg';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','ticket_id','text','added_on'
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
