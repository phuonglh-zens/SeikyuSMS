<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCollationLog extends Model
{
    use HasFactory;

    protected $table = 'user_collation_logs';
    protected $guarded = [];
}
