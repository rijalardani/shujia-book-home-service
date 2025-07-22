<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionDetails extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'booking_transaction_id',
        'home_service_id',
        'price',  
    ];

    public function bookingTransaction() : BelongsTo
    {
        return $this->belongsTo(BookingTransaction::class, 'booking_transaction_id');
    }

    public function homeService() : BelongsTo
    {
        return $this->belongsTo(HomeService::class, 'home_service_id');
    }
}
