<?php

namespace App\Models;

use App\Http\Controllers\GoogleApiService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class GoogleAccount extends Model
{

    use HasFactory;
    //protected $hidden=['Oauth'];
    protected $fillable = ['email', 'daily_limit', 'hourly_limit'];
    protected $appends = ['Oauth'];

    public function getOauthAttribute()
    {
        $gApi = new GoogleApiService($this);

        if (empty($this->auth_token)) {
            return false;
        } else {
            if ($gApi->is_connected) {
                return true;
            } else {
                return "expired";
            }
        }
    }
}
