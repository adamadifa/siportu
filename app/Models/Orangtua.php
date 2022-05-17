<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Orangtua extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'user_orangtua';
    protected $primaryKey = 'nik';
    protected $guarded = [];
    public $incrementing = false;
    protected $hidden = [
        'password', 'remember_token',
    ];
}
