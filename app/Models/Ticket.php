<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model 
{
    protected $table = 'ticket';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','title','coin','amount'
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
    public function messages()
    {
        return $this->hasMany(TicketMsg::class);
    }
}
