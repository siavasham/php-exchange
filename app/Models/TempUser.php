<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TempUser extends Model
{
    public $timestamps = false;
    protected $table = 'temp_users';
    protected $fillable = [
        'name','email','password','lang','referral','code','try','time'
    ];

    public function __construct(array $attributes = [])
    {
        if (! isset($attributes['code'])) {
            $attributes['code'] = $this->generateCode();
        }
        $attributes['try'] = 0;

        parent::__construct($attributes);
    }

    /**
     * Generate a six digits code
     *
     * @param int $codeLength
     * @return string
     */
    public function generateCode()
    {
        $code = mt_rand(100000,999999);
        return ''.$code;
    }

    /**
     * True if the token is not used nor expired
     *
     * @return bool
     */
    public function isValid()
    {
        return ! $this->isVerified() && ! $this->isExpired();
    }

    /**
     * Is the current token used
     *
     * @return bool
     */
    public function isVerified()
    {
        return $this->verified;
    }
    public function manyTrid()
    {
        $tryTime =  env('TOKEN_TRY_TIME');
        return $this->try > $tryTime;
    }

    /**
     * Is the current token expired
     *
     * @return bool
     */
    public function isExpired()
    {
        $expireTime = env('OTA_TOKEN_EXPIRE');
  
        return $this->created_at <  Carbon::now()->subMinutes($expireTime) ;
    }
}
