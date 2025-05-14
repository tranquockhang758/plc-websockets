<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    use HasFactory;
    protected $table = 'controls';
    protected $fillable = [
        'M_START',
        'M_STOP',
        'M_MODE',
        'M_RESET',
        'created_at',
        'updated_at'
    ];
}
