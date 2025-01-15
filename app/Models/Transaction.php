<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Transaction extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'payment_method',
        'external_id',
        'transaction_code',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['user_id', 'amount', 'status', 'payment_method'])
            ->useLogName('transaction')
            ->logOnlyDirty() // Log apenas alterações nos atributos.
            ->dontSubmitEmptyLogs(); // Evita logs vazios.
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Transação foi {$eventName}";
    }
}
