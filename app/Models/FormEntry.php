<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_name',
        'name',
        'email',
        'phone',
        'company',
        'service',
        'budget',
        'message',
        'status',
        'ip_address',
        'user_agent',
    ];
}
