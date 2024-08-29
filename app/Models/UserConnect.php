<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserConnect extends Model
{
    use HasFactory;

    protected $table = 'user_connects';
    protected $guarded = [];

    public function userInfo()
    {
        return $this->belongsTo(UserInfo::class, 'user_id');
    }
}
