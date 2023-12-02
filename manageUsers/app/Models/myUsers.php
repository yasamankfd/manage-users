<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class myUsers extends Model
{
    use HasFactory;
    protected $table = 'my_users';
    protected $fillable = [
        'name',
        'email',
        'lastname',
        'pass',
        'avatar',
        'status'
    ];
}
