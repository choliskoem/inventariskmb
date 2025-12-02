<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSimple extends Model
{
    use HasFactory;
    protected $table = 'usersimple';
    protected $fillable = ['nama', 'email'];

}
