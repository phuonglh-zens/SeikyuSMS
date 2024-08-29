<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserInfo extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user_infos';
    protected $guarded = [];

    public function connectors()
    {
        return $this->hasMany(UserConnect::class, 'user_id');
    }
}
