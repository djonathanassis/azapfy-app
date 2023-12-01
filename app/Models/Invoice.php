<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\Tenantable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invoice extends Model
{
    use HasFactory, Notifiable, Tenantable;

    protected $guarded = ['id'];

    protected $fillable = [
        'number',
        'amount',
        'date_emissary',
        'cnpj_retirement',
        'name_retirement',
        'cnpj_transporter',
        'name_transporter',
    ];
}
