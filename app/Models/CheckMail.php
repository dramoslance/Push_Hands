<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckMail extends Model
{
    use HasFactory;
    protected $table = 'check_mails';

    protected $fillable = [
        'email',
        'token',
        'status'
    ];
}